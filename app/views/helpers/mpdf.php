<?php

define("_MPDF_TEMP_PATH", TMP);


App::import('Vendor','mpdf50/mpdf');



//if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~');

class MpdfHelper extends AppHelper {
   
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

        $this->Pdf = new mPDF(
                LC_ALL, // Locale 'es'
                $format, // A4 letter, etc
                Configure::read('Fpdf.fontSize'),
                Configure::read('Fpdf.fontFamily'),
                0, 0, 0, 0, //margenes en cero
                $orientation
                );


        //$this->setup($orientation, $unit, $format);
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
        //return $this->Pdf->MultiCell($w, $h, $txt, $border, $align, $fill);
        return $this->MultiCellMaxLine($w, $h, $txt, $border, $align, $fill,$maxLine);
    }


    function Write($h, $txt, $link='') {
        return $this->Pdf->Write($h, $txt, $link);
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
        $this->Pdf->AutosizeText($txt, $w, $this->Pdf->FontFamily, 72);
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

    
    /**
     * 
     *    @param string $text UTF-8 encoded text to write. Single line only.
          @param float $width Width of text in millimeters. The font size will be reduced if required to fit this size.
          @param string $font Font family to use
          @param string $style Font style used [blank for normal]|i|b|bi
          @param float $fontsize Maximm font size in points (pt) Default = 72

     * 
     * 
     */
    function AutosizeText($text, $width, $font = null, $style = '', $fontsize = 20){
        if (empty($font)) {
            $font = Configure::read('Fpdf.fontFamily');
        }
        return $this->Pdf->AutosizeText($text, $width, $font, $style, $fontsize);
    }
    

       //$this->MultiCellMaxLine($w, $h, $txt, $border, $align, $fill,$maxLine);
     function MultiCellMaxLine($w, $h, $txt, $border=0, $align='J', $fill=0, $maxline=0)
    {
         //debug($this->Pdf);die;
        //Output text with automatic or explicit line breaks, maximum of $maxlines
        $cw=&$this->Pdf->CurrentFont['cw'];
        if($w==0)
            $w=$this->Pdf->w-$this->Pdf->rMargin-$this->Pdf->x;
        $wmax=($w-2*$this->Pdf->cMargin)*1000/$this->Pdf->FontSize;
        $s=str_replace("\r", '', $txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $b=0;
        if($border)
        {
            if($border==1)
            {
                $border='LTRB';
                $b='LRT';
                $b2='LR';
            }
            else
            {
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
        while($i<$nb)
        {
            //Get next character
            $c=$s[$i];
            if($c=="\n")
            {
                //Explicit line break
                if($this->Pdf->ws>0)
                {
                    $this->Pdf->ws=0;
                    $this->Pdf->_out('0 Tw');
                }
                $this->Pdf->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
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
            if($c==' ')
            {
                $sep=$i;
                $ls=$l;
                $ns++;
            }
            $l+=$cw[$c];
            if($l>$wmax)
            {
                //Automatic line break
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                    if($this->Pdf->ws>0)
                    {
                        $this->Pdf->ws=0;
                        $this->Pdf->_out('0 Tw');
                    }
                    $this->Pdf->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
                }
                else
                {
                    if($align=='J')
                    {
                        $this->Pdf->ws=($ns>1) ? ($wmax-$ls)/1000*$this->Pdf->FontSize/($ns-1) : 0;
                        $this->Pdf->_out(sprintf('%.3f Tw', $this->Pdf->ws*$this->Pdf->k));
                    }
                    $this->Pdf->Cell($w, $h, substr($s, $j, $sep-$j), $b, 2, $align, $fill);
                    $i=$sep+1;
                }
                $sep=-1;
                $j=$i;
                $l=0;
                $ns=0;
                $nl++;
                if($border and $nl==2)
                    $b=$b2;
                if ( $maxline  && $nl > $maxline )
                    return substr($s, $i);
            }
            else
                $i++;
        }
        //Last chunk
        if($this->Pdf->ws>0)
        {
            $this->Pdf->ws=0;
            $this->Pdf->_out('0 Tw');
        }
        if($border and is_int(strpos($border, 'B')))
            $b.='B';
        $this->Pdf->Cell($w, $h, substr($s, $j, $i-$j), $b, 2, $align, $fill);
        $this->Pdf->x=$this->Pdf->lMargin;
        return '';
    }


    
}


