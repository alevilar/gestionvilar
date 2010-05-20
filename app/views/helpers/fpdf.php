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
        $orientation='P';
        $unit='mm';
        $format='legal';
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
        $this->Pdf = new Paperpdf();

        $this->Pdf->FPDF($orientation, $unit, $format);
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


    function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false){
        $this->Pdf->MultiCell($w, $h, $txt, $border, $align, $fill);
    }

    
    function fondoVerde(){
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
    function SetFont($family, $style='', $size=0) {
        $this->Pdf->SetFont($family, $style, $size);
    }


    /**
     * pone el cursor en una posicion X Y
     *
     * @param <type> $x
     * @param <type> $y
     */
    function SetXY($x, $y) {
        $this->Pdf->SetXY($x, $y);
    }

    /**
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
    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='') {
        $txt = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $txt);
        $this->Pdf->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
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