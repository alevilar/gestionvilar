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
    

    
   $this->Fpdf->bordeRojo();
   $this->Fpdf->fondoVerde();

    $s = 'estoy probando el tamaño de un texto';
    $this->Fpdf->Text(20,20,$s);

    $this->Fpdf->SetXY(60, 100);
   // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='C', $fill=true, $link='')
    $this->Fpdf->Cell(60,5,$s,1, 0, 'L', true);

    
    $tam = $this->Fpdf->GetStringWidth($s);

    debug($tam);
   

// debug($this->Fpdf->Pdf);
echo $this->Fpdf->output('probando_page.pdf','i');

