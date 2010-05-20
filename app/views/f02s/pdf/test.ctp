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

    $this->Fpdf->SetXY(60, 90);
    $this->Fpdf->Cell(60,0,'TEXTO texto ::$ Arial');
    
    
    $this->Fpdf->SetFont('Times','',12);

    $this->Fpdf->SetXY(60, 110);
    $this->Fpdf->Cell(60,0,'TEXTO texto ::$ Times');


    $this->Fpdf->SetFont('Symbol','',12);

    $this->Fpdf->SetXY(60, 120);
    $this->Fpdf->Cell(60,0,'TEXTO texto ::$  Symbol');


    $this->Fpdf->SetFont('ZapfDingbats','',12);

    $this->Fpdf->SetXY(60, 130);
    $this->Fpdf->Cell(60,0,'TEXTO texto ::$  ZapfDingbats');


// debug($this->Fpdf->Pdf);
echo $this->Fpdf->output('probando_margenes_page.pdf','i');

