<?
$pdfLibrery = 'Fpdf';
//$pdfLibrery = 'Mpdf';


$this->{$pdfLibrery}->AddPage();
$this->{$pdfLibrery}->SetFont('Helvetica','B',10);
//$this->{$pdfLibrery}->SetMargins(10,25);
/*
 Courier
     *      Helvetica o Arial
     *      Times
     *      Symbol
     *      ZapfDingbats
*/
    $this->{$pdfLibrery}->SetXY(60, 100);
    $this->{$pdfLibrery}->Cell(60,0,'TEXTO texto ::$ Helvetica');


    $this->{$pdfLibrery}->SetFont('Arial','',10);

    $this->{$pdfLibrery}->SetXY(0, 3);
    $this->{$pdfLibrery}->Cell(30,5,'XXXXX 0 3',1,'','C',1);


     $this->{$pdfLibrery}->SetXY(0, 10);
    $this->{$pdfLibrery}->fondoVerde();
    $this->{$pdfLibrery}->Cell(30,10,'XXXXX 0 10',1,'','C',1);


    $this->{$pdfLibrery}->SetXY(10, 115);
    $this->{$pdfLibrery}->fondoVerde();
    $this->{$pdfLibrery}->Cell(30,10,'XXXXX 10 115',1,'','C',1);
    


    $this->{$pdfLibrery}->fondoVerde();
    
    $opts['x'] = 99;
    $opts['y'] = 200;
    $opts['w'] =  100;
    $opts['h'] = 10;
    $opts['txt'] = ' deberia escfibir aca muchas cosas y no hhabria problema porque esto escribe para aabajo tiene ganas d eescribir y lo escribe no es fenomenaleso?';
    $opts['renglones_max'] = 2;
    //  xyMultiCell($x, $y, $txt = '', $w = 0, $h = 0, $border=0, $align='J', $fill=true)
    $this->{$pdfLibrery}->xyMultiCell($opts);
   

// debug($this->{$pdfLibrery}->Pdf);
//    S/ envia como string
    // f envia para descargar
echo $this->{$pdfLibrery}->output('probando_margenes_page.pdf','i');

