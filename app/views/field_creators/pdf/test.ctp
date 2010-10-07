<?



$this->Fpdf->AddPage();
$this->Fpdf->SetFont('Helvetica','B',10);
//$this->Fpdf->SetMargins(10,25);
/*
 Courier
     *      Helvetica o Arial
     *      Times
     *      Symbol
     *      ZapfDingbats
*/
    $this->Fpdf->SetXY(60, 100);
    $this->Fpdf->Cell(60,0,'TEXTO texto ::$ Helvetica');


    $this->Fpdf->SetFont('Arial','',10);

    $this->Fpdf->SetXY(0, 3);
    $this->Fpdf->Cell(30,5,'XXXXX',1,'','C',1);


     $this->Fpdf->SetXY(0, 10);
    $this->Fpdf->fondoVerde();
    $this->Fpdf->Cell(30,10,'XXXXX',1,'','C',1);


    $this->Fpdf->SetXY(10, 115);
    $this->Fpdf->fondoVerde();
    $this->Fpdf->Cell(30,10,'XXXXX',1,'','C',1);
    



    $this->Fpdf->fondoVerde();
    //  xyMultiCell($x, $y, $txt = '', $w = 0, $h = 0, $border=0, $align='J', $fill=true)
    $this->Fpdf->xyMultiCell(10, 120,'Probando ',60,8,1,'','J',1);
   

// debug($this->Fpdf->Pdf);
echo $this->Fpdf->output('probando_margenes_page.pdf','i');

