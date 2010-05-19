<?

$this->Fpdf->Pdf->AddPage();
$this->Fpdf->Pdf->SetFont('Arial','B',10);
$this->Fpdf->Pdf->SetXY('110','110');
$this->Fpdf->Pdf->Cell(40,10,'110x110 Arial B');

$this->Fpdf->Pdf->SetXY('20','20');
$this->Fpdf->Pdf->Cell(40,10,'20x20 Arial B');

$this->Fpdf->Pdf->SetXY('0','0');
$this->Fpdf->Pdf->Cell(40,10,'X');

$this->Fpdf->Pdf->SetXY('198','0');
$this->Fpdf->Pdf->Cell(40,10,'X');

$this->Fpdf->Pdf->SetXY('0','348');
$this->Fpdf->Pdf->Cell(40,10,'X');

$this->Fpdf->Pdf->SetXY('0','359');
$this->Fpdf->Pdf->Cell(40,10,'X');
//
//
//    $this->Fpdf->Pdf->SetXY('204','390');
//    $this->Fpdf->Pdf->Cell(40,10,'X');
//
//    $this->Fpdf->Pdf->SetXY('0','0');
//    $this->Fpdf->Pdf->Cell(40,10,'a');


$this->Fpdf->Pdf->SetFont('Times','B',12);
$this->Fpdf->Pdf->SetXY('20','110');
$this->Fpdf->Pdf->Cell(40,10,'20x110 TImes B');



// debug($this->Fpdf->Pdf);
echo $this->Fpdf->output('page.pdf','i');

