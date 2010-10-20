<?php
App::import('Vendor','fpdf/fpdf');

if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~');

class FpdfHelper extends AppHelper {
    /* @var $this Paperpdf  */
    var $Paperpdf;

    /**
     *
     * @param array $settings[0] orientation  default 'P' Portait
     *              $settings[1] unit default 'mm' milimetros
     *              $settings[2] format default letter
     *          if settings es String es el 'format'
     */
    function __construct($settings = array()) {
        $orientation= Configure::read('Fpdf.orientation');
        $unit= Configure::read('Fpdf.unit');
        $format= Configure::read('Fpdf.format');
        if (is_array($settings)) {
            foreach ($settings as $key => $val) {
                switch ($key) {
                    case 'orientation':$orientation=$val;
                        break;
                    case 'unit':$unit=$val;
                        break;
                    case 'format':$format=$val;
                        break;
                    default: break;
                }
                $className = $settings[0];
            }
        } elseif (is_string($settings)) {
            $format= $settings;
        }
        //$this->Pdf = new Paperpdf();
        $this->Pdf = new FPDFCellFit();

        $this->Pdf->FPDF($orientation, $unit, $format);
    }


    /**
     * imprime las paginas llenas de campos pasadas como parametro
     *
     * @param array $pages array de paginas que contienen los campos a imprimir
     * @param array $options
     *                  lasopciones posibles son:
     *                  'Printer' es el Model leido parala imresora e indica el desplazamiento a realizar en las coordenaadas X, Y
     *                  'debug' si esta en 'true' me muestra fondos coloreados en las celdas y multiceldas
     *                  'output' son las distintas salidads que puede tener el Pdf vendor (ver documentacion de la libreria para mas info) default: 'i'
     *                  'filename' nombre del archivo a escupir
     *
     */
    function printPages($pages, $options){
        if (!empty($options['debug'])) {
            $this->fondoVerde();
            $this->bordeRojo();
        } else {
            $this->fondoBlanco();
            $this->bordeBlanco();
        }

        //inicializo configuracion de impresora
        if (empty($options['Printer'])) {
            $printer['Printer']['x'] = $printer['Printer']['y'] = 0;
        } else {
            $printer['Printer'] = $options['Printer'];
        }

        //inicializo el output
         if (empty($options['output'])) {
             $options['output'] = 'i';
         }

         //inicializo el nombre del archivo a fabricar
         if (empty($options['filename'])) {
             $options['filename'] = date('y-m-d-H-i-s');
         }
        
        $this->SetFont();

        $this->__meterPaginas($pages, $printer);

        // show inline, descarga o muestra en browser si tiene el plugin instalado
        return $this->output($options['filename'].'.pdf',$options['output']);

    }

    /**
     * Settea cada una delaspaginas del array
     *
     * @param array $pages paginas a imprimir
     * @param Model Printer $printer coordenadas x, y a desplazar segun impresora
     */
    private function __meterPaginas($pages, $printer){
        foreach ($pages as $p) {
            if (count($p)>0) {
                $this->AddPage();
            }
            // meter texto para cada pagina
            foreach ($p as $f) {
                $this->__meterTexto($f, $printer);
            }
        }
    }


    /**
     *
     * @param array fieldCoordenateData $f informacion del campo a mostrar en el pdf
     * @param array del model Printer $printer coordenadas x,y a desplazar segun impresora
     */
    private function __meterTexto($f, $printer){
        $c = $f['FieldCoordenate'];
        $fType = $f['FieldType']['function'];

        if (!empty($c['value'])) {
            $c['x'] = (int)$c['x'] + (int)$printer['Printer']['x'];
            $c['y'] = (int)$c['y'] + (int)$printer['Printer']['y'];

            $c['txt'] = iconv('UTF-8', Configure::read('Fpdf.iconvSource'), $c['value'] );;
            $this->SetFontSize(floatval($c['font_size']));
            $textoImprimio = $this->printStuff($fType,$c);
            
            if ($textoImprimio != $c['value'] && !empty($c['FieldCoordenate'])){
                $this->__meterTexto($c, $printer);
            }
        }
    }


    /**
     * Funcion principal que maneja todas las funciones de ésta clase.
     * es la que se llama desde la vista que usa el helper
     *
     * @param string $functionName nombre de la funcion de ésta clase que quiero utilizar: Ej: MultiCell();
     * @param array $options  opciones o parámetros de la funcion anteriormente citada
     */
    function printStuff($functionName, $options = array()){
        $this->{$functionName}($options);
    }




    function Text($opts) {
        $opts['txt'] = $opts['txt'];
        return $this->Pdf->Text($opts['x'], $opts['y'], $opts['txt']);
    }

    function xyMultiCell($opts) {
        $this->SetXY($opts['x'], $opts['y']);
        $v = $this->MultiCell(
                $opts['w'],
                $opts['h'],
                empty($opts['txt'])?null:$opts['txt'],
                empty($opts['border'])?true:$opts['border'],
                empty($opts['align'])?null:$opts['align'],
                empty($opts['fill'])?true:$opts['fill'],
                empty($opts['renglones_max'])?null:$opts['renglones_max']
                );
        
        return $v;
    }

    function xyCell($opts) {
        $this->SetXY($opts['x'], $opts['y']);
        return $this->Cell(
                $opts['w'],
                $opts['h'],
                empty($opts['txt'])?null:$opts['txt'],
                empty($opts['border'])?true:$opts['border'],
                empty($opts['ln'])?null:$opts['ln'],
                empty($opts['align'])?null:$opts['align'],
                empty($opts['fill'])?true:$opts['fill'],
                empty($opts['link'])?null:$opts['link']
                );
    }


    function xyLetra($opts) {
        $this->SetXY($opts['x'], $opts['y']);
        return $this->MultiCell(
                $opts['w'],
                $opts['h'],
                empty($opts['txt'])?null:$opts['txt'],
                empty($opts['border'])?true:$opts['border'],
                empty($opts['align'])?null:$opts['align'],
                empty($opts['fill'])?true:$opts['fill'],
                empty($opts['renglones_max'])?null:$opts['renglon_max']
                );
    }


    function xyCeldaAjustable($opts) {
        $this->SetXY($opts['x'], $opts['y']);
        return $this->Pdf->CellFit(
                $opts['w'],
                $opts['h'],
                empty($opts['txt'])?null:$opts['txt'],
                empty($opts['border'])?true:$opts['border'],
                empty($opts['ln'])?null:$opts['ln'],
                empty($opts['align'])?null:$opts['align'],
                empty($opts['fill'])?true:$opts['fill'],
                empty($opts['link'])?null:$opts['link'],
                1,
                0
                );
    }


    function xyVCell($opts){
        $this->SetXY($opts['x'], $opts['y']);
        return $this->Pdf->VCell(
                $opts['w'],
                $opts['h'],
                empty($opts['txt'])?null:$opts['txt'],
                empty($opts['border'])?true:$opts['border'],
                0, //ln
                empty($opts['align'])?null:$opts['align'],
                empty($opts['fill'])?true:$opts['fill']
                );
    }




    /**
     * Allows you to change the defaults set in the FPDF constructor
     *
     * @param string $orientation page orientation values: P, Portrait, L, or Landscape    (default is P)
     * @param string $unit values: pt (point 1/72 of an inch), mm, cm, in. Default is mm
     * @param string $format values: A3, A4, A5, Letter, Legal or a two element array with the width and height in unit given in $unit
     */
    function setup ($orientation='P',$unit='mm',$format='A4') {
        $this->Pdf($orientation, $unit, $format);
    }


    function AddPage($orientation='', $format='') {
        $this->Pdf->AddPage($orientation, $format);
    }


    function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=true, $maxLine = 0) {
        return $this->Pdf->MultiCellMaxLine($w, $h, $txt, $border, $align, $fill,$maxLine);
    }




    function Write($h, $txt, $link='') {
        return $this->Pdf->Write($h, $txt, $link);
    }

    function cellDate($x,$y,$date) {
        if (!empty($date)) {
            $this->Pdf->SetXY($x,$y);
            $this->Pdf->Cell(7,3,date('d',strtotime($date)));

            $this->Pdf->SetXY($x+9,$y);
            $this->Pdf->Cell(7,3,date('m',strtotime($date)));

            $this->Pdf->SetXY($x+18,$y);
            $this->Pdf->Cell(7,3,date('y',strtotime($date)));
        }
    }


    /**
     *  Me imprime en el PDF 3 posibles identificaciones, me llena el multiple choice
     *
     * @param integer $w_start coordenada X donde comienza el primer cuadradito
     * @param integer $h coordenada Y que no se modifica
     * @param integer $id_type tipo d eidentificacion, de la tabla identification_types, es el ID de la identificacion
     */
    function setIdentificationType($w_start, $h, $id_type) {
        switch ($id_type) {
            case 1: // DNI
                $this->Pdf->SetXY($w_start,$h);
                break;
            case 3: // LE
            case 5: // CI
                $this->Pdf->SetXY($w_start+10,$h);
                break;
            case 4: // LC
            case 6: // Pasaporte
                $this->Pdf->SetXY($w_start+20,$h);
                break;
            default: break;
        }
        $this->Pdf->Cell(3,4,'X');
    }


    function bordeBlanco() {
        $this->Pdf->SetDrawColor(255, 255, 255);
    }

    function bordeRojo() {
        $this->Pdf->SetDrawColor(255, 0, 0);
    }

    function fondoBlanco() {
        $this->Pdf->SetFillColor(255, 255, 255);
    }
    function fondoVerde() {
        $this->Pdf->SetFillColor(218, 223, 183);
    }

    /**
     * @param string $family
     *      Courier
     *      Helvetica o Arial
     *      Times
     *      Symbol
     *      ZapfDingbats
     *
     *
     * @param string $style
     *      cadena vacia: regular
     *      B: bold
     *      I: italic
     *      U: underline
     *
     * @param integer $size
     */
    function SetFont($family = null, $style='B', $size=10) {
        if (empty($family)) {
            $family = Configure::read('Fpdf.fontFamily');
        }
        return $this->Pdf->SetFont($family, $style, $size);
    }

    /**
     *
     * @param float $size  El tamaño (en puntos).
     */
    function SetFontSize($size) {
        return $this->Pdf->SetFontSize($size);
    }

    function GetStringWidth($s) {
        return $this->Pdf->GetStringWidth($s);
    }



    /**
     * Define el creador de el documento. Este es típicamente el nombre de
     * la aplicación que genera el pdf.
     * @param string creator nombre de la persona o aplicacion que genera el documento
     */
    function SetCreator($creator, $isUTF8=false) {
        return $this->Pdf->SetCreator($creator, $isUTF8);
    }
    /**
     * pone el cursor en una posicion X Y
     *
     * @param <type> $x
     * @param <type> $y
     */
    function SetXY($x, $y) {
        return $this->Pdf->SetXY($x, $y);
    }

    /**
     * Imprime texto en una celda., y si el txp no entra trunca hasta la ultima palabra. No recorta las palabras por el medio
     *
     * @param <type> $w width
     * @param <type> $h heigth default 0
     * @param <type> $txt texto convertuido e UTF-8 a ISO
     * @param <type> $border
     * @param <type> $ln
     * @param string $align
     L o una cadena vacia: alineación izquierda (valor por defecto)
     C: centro
     R: alineación derecha
     * @param <type> $fill
     * @param <type> $link
     */
    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='C', $fill = true, $link='') {
        if ($w < $this->GetStringWidth($txt)) {
            // recorto el texto si sobrepasa el ancho de la celda
            $txtAuxCort = '';
            $txtAux='';
            for($i= 0;$w >= $this->GetStringWidth($txtAuxCort);$i++) {
                $txtAux .= substr($txt, $i,1);
                $txtAuxCort = $txtAux;
            }

            $txt = $txtAux;
        }
        $this->Pdf->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
        return $txt;
    }


    function SetMargins($left, $top, $right=null) {
        $this->Pdf->SetMargins($left, $top, $right);
    }


    /**
     * Allows you to control how the pdf is returned to the user, most of the time in CakePHP you probably want the string
     *
     * @param string $name name of the file.
     * @param string $destination where to send the document values: I, D, F, S
     * @return string if the $destination is S
     */
    function output ($name = 'page.pdf', $destination = 's') {
        // I: send the file inline to the browser. The plug-in is used if available.
        //    The name given by name is used when one selects the "Save as" option on the link generating the PDF.
        // D: send to the browser and force a file download with the name given by name.
        // F: save to a local file with the name given by name.
        // S: return the document as a string. name is ignored.
        return $this->Pdf->Output($name, $destination);
    }
}




// para borrar el ultimo char del string
//substr_replace($string ,"",-1);


class Paperpdf extends FPDF {
    var $javascript;
    var $n_js;

    function IncludeJS($script) {
        $this->javascript=$script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
}





/**
 * Extension sacada de esta pagina
 * sirva para que si un texto es demasiado largo me entre en una celda.
 * me puede comprimir o agrandar el texto
 *
 * para agrandar una word spacing o character spacing
 * puede llegar  aser util en los formularios que cada letra va en un cuadradito
 *
 * http://www.fpdf.de/downloads/addons/62/
 */
class FPDFCellFit extends FPDF {

    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $scale=0, $force=1) {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $ratio=($w-$this->cMargin*2)/$str_width;

        $fit=($ratio < 1 || ($ratio > 1 && $force == 1));
        if ($fit) {
            switch ($scale) {

                //Character spacing
                case 0:
                //Calculate character spacing in points
                    $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1, 1)*$this->k;
                    //Set character spacing
                    $this->_out(sprintf('BT %.2f Tc ET', $char_space));
                    break;

                //Horizontal scaling
                case 1:
                //Calculate horizontal scaling
                    $horiz_scale=$ratio*100.0;
                    //Set horizontal scaling
                    $this->_out(sprintf('BT %.2f Tz ET', $horiz_scale));
                    break;

            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
        
        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale==0 ? '0 Tc' : '100 Tz').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=1, $link='') {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, 1, 0);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=1, $link='') {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, 1, 1);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=1, $link='') {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, 0, 0);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=1, $link='') {
        //Same as calling CellFit directly
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, 0, 1);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s) {
        if($this->CurrentFont['type']=='Type0') {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++) {
                if (ord($s[$i])<128)
                    $len++;
                else {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }


    /**
     * Imprime Celdas de forma vertical
     *
     * @param <type> $w
     * @param <type> $h
     * @param <type> $txt
     * @param <type> $border
     * @param <type> $ln
     * @param <type> $align
     * @param <type> $fill
     */
    function VCell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=1) {
        //Output a cell
        $k=$this->k;
        if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak()) {
            $x=$this->x;
            $ws=$this->ws;
            if($ws>0) {
                $this->ws=0;
                $this->_out('0 Tw');
            }
            $this->AddPage($this->CurOrientation);
            $this->x=$x;
            if($ws>0) {
                $this->ws=$ws;
                $this->_out(sprintf('%.3f Tw', $ws*$k));
            }
        }
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $s='';
// begin change Cell function
        if($fill==1 or $border>0) {
            if($fill==1)
                $op=($border>0) ? 'B' : 'f';
            else
                $op='S';
            if ($border>1) {
                $s=sprintf(' q %.2f w %.2f %.2f %.2f %.2f re %s Q ', $border,
                        $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
            }
            else
                $s=sprintf('%.2f %.2f %.2f %.2f re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
        }
        if(is_string($border)) {
            $x=$this->x;
            $y=$this->y;
            if(is_int(strpos($border, 'L')))
                $s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);
            else if(is_int(strpos($border, 'l')))
                $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);

            if(is_int(strpos($border, 'T')))
                $s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);
            else if(is_int(strpos($border, 't')))
                $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);

            if(is_int(strpos($border, 'R')))
                $s.=sprintf('%.2f %.2f m %.2f %.2f l S ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
            else if(is_int(strpos($border, 'r')))
                $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);

            if(is_int(strpos($border, 'B')))
                $s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
            else if(is_int(strpos($border, 'b')))
                $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
        }
        if(trim($txt)!='') {
            $cr=substr_count($txt, "\n");
            if ($cr>0) { // Multi line
                $txts = explode("\n", $txt);
                $lines = count($txts);
                for($l=0;$l<$lines;$l++) {
                    $txt=$txts[$l];
                    $w_txt=$this->GetStringWidth($txt);
                    if ($align=='U')
                        $dy=$this->cMargin+$w_txt;
                    elseif($align=='D')
                        $dy=$h-$this->cMargin;
                    else
                        $dy=($h+$w_txt)/2;
                    $txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
                    if($this->ColorFlag)
                        $s.='q '.$this->TextColor.' ';
                    $s.=sprintf('BT 0 1 -1 0 %.2f %.2f Tm (%s) Tj ET ',
                            ($this->x+.5*$w+(.7+$l-$lines/2)*$this->FontSize)*$k,
                            ($this->h-($this->y+$dy))*$k, $txt);
                    if($this->ColorFlag)
                        $s.='Q ';
                }
            }
            else { // Single line
                $w_txt=$this->GetStringWidth($txt);
                $Tz=100;
                if ($w_txt>$h-2*$this->cMargin) {
                    $Tz=($h-2*$this->cMargin)/$w_txt*100;
                    $w_txt=$h-2*$this->cMargin;
                }
                if ($align=='U')
                    $dy=$this->cMargin+$w_txt;
                elseif($align=='D')
                    $dy=$h-$this->cMargin;
                else
                    $dy=($h+$w_txt)/2;
                $txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
                if($this->ColorFlag)
                    $s.='q '.$this->TextColor.' ';
                $s.=sprintf('q BT 0 1 -1 0 %.2f %.2f Tm %.2f Tz (%s) Tj ET Q ',
                        ($this->x+.5*$w+.3*$this->FontSize)*$k,
                        ($this->h-($this->y+$dy))*$k, $Tz, $txt);
                if($this->ColorFlag)
                    $s.='Q ';
            }
        }
// end change Cell function
        if($s)
            $this->_out($s);
        $this->lasth=$h;
        if($ln>0) {
            //Go to next line
            $this->y+=$h;
            if($ln==1)
                $this->x=$this->lMargin;
        }
        else
            $this->x+=$w;
    }




    function MultiCellMaxLine($w, $h, $txt, $border=0, $align='J', $fill=1, $maxline=0) {
        //Output text with automatic or explicit line breaks, maximum of $maxlines
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r", '', $txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $b=0;
        if($border) {
            if($border==1) {
                $border='LTRB';
                $b='LRT';
                $b2='LR';
            }
            else {
                $b2='';
                if(is_int(strpos($border, 'L')))
                    $b2.='L';
                if(is_int(strpos($border, 'R')))
                    $b2.='R';
                $b=is_int(strpos($border, 'T')) ? $b2.'T' : $b2;
            }
        }
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $ns=0;
        $nl=1;
        while($i<$nb) {
            //Get next character
            $c=$s[$i];
            if($c=="\n") {
                //Explicit line break
                if($this->ws>0) {
                    $this->ws=0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border and $nl==2)
                    $b=$b2;
                if ( $maxline  && $nl > $maxline )
                    return substr($s, $i);
                continue;
            }
            if($c==' ') {
                $sep=$i;
                $ls=$l;
                $ns++;
            }
            $l+=$cw[$c];
            if($l>$wmax) {
                //Automatic line break
                if($sep==-1) {
                    if($i==$j)
                        $i++;
                    if($this->ws>0) {
                        $this->ws=0;
                        $this->_out('0 Tw');
                    }
                    $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
                }
                else {
                    if($align=='J') {
                        $this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                        $this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
                    }
                    if ($nl == $maxline) {// si es la ultima linea que escriba todo y que lo comprima con FitScale
                        $this->CellFitScale($w, $h, substr($s, $j), $b, 2, $align, $fill);
                    } else {
                        $this->Cell($w, $h, substr($s, $j, $sep-$j), $b, 2, $align, $fill);
                    }
                    $i=$sep+1;
                }
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border and $nl==2)
                    $b=$b2;
                if ( $maxline  && $nl > $maxline ){
                    //die("aaaa");
                    return substr($s, $i);
                }
            }
            else
                $i++;
        }
        //Last chunk
        if($this->ws>0) {
            $this->ws=0;
            $this->_out('0 Tw');
        }
        if($border and is_int(strpos($border, 'B')))
            $b.='B';
        $this->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
        $this->x=$this->lMargin;
        return '';
    }



}
