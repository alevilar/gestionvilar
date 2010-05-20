<?

$form;
$f02types;

//debug($form);die();

$this->Fpdf->AddPage();


// PATENTE
$this->Fpdf->SetFont('Arial','B',10);
$this->Fpdf->SetXY('95','47');
$this->Fpdf->Cell(30,10,$form['Vehicle']['patente']);


// SOLICITUD DE:
$this->Fpdf->SetFont('Arial','',10);
switch ($form['F02']['type']){
    case 0:  $this->Fpdf->SetXY('46','69');break;
    case 1:  $this->Fpdf->SetXY('46','78');break;
    case 2:  $this->Fpdf->SetXY('46','87');break;
    case 3:  $this->Fpdf->SetXY('46','94');break;
    case 4:  $this->Fpdf->SetXY('46','102');break;
    case 5:  $this->Fpdf->SetXY('46','108');break;
    case 6:  $this->Fpdf->SetXY('46','117');break;
    case 7:  $this->Fpdf->SetXY('46','120');break;
    case 8:  $this->Fpdf->SetXY('46','124');break;
    case 9:  $this->Fpdf->SetXY('46','131');break;
    case 10: $this->Fpdf->SetXY('46','135');break;
    case 11: $this->Fpdf->SetXY('46','180');break;
    case 12: $this->Fpdf->SetXY('46','144');break;
    case 13: $this->Fpdf->SetXY('46','150');break;
    case 14: $this->Fpdf->SetXY('46','156');break;
    case 15: $this->Fpdf->SetXY('46','162');break;
    case 16: $this->Fpdf->SetXY('46','168');break;
    case 17: $this->Fpdf->SetXY('46','174');break;
    case 18: $this->Fpdf->SetXY('46','178');break;
    case 19: $this->Fpdf->SetXY('46','183');break;
    default: break;
}
$this->Fpdf->Cell(3,3,'X');



// DECLARACIONES
$this->Fpdf->SetXY(45,195);
$this->Fpdf->MultiCell(150,4,$form['F02']['declaraciones'],0,'j');



// SOLICITANTE
$this->Fpdf->SetXY(45,214);
$this->Fpdf->Cell(70,10,$form['F02']['solicitante'],0, 0,'C');

// APODERADO
if (!empty($form['Representative'])) {
    $this->Fpdf->SetXY(55,232);
    $this->Fpdf->Cell(60,10,$form['Representative']['surname'].' '.$form['Representative']['name'],0, 0,'C');

    if ($form['Representative']['nationality_type'] == 'argentino') {        
        switch ($form['Representative']['identification_type_id']) {
            case 1: // DNI
                $this->Fpdf->SetXY(49,250);
                $this->Fpdf->Cell(3,3,'X');
                break;
            case 3: // LE
                $this->Fpdf->SetXY(59,250);
                $this->Fpdf->Cell(3,3,'X');
                break;
            case 4: // LC
                $this->Fpdf->SetXY(69,250);
                $this->Fpdf->Cell(3,3,'X');
                break;
            default: break;
        } 
    } else {
          switch ($form['Representative']['identification_type_id']) {
            case 1: // DNI
                $this->Fpdf->SetXY(93,250);
                $this->Fpdf->Cell(3,3,'X');
                break;
            case 5: // CI
                $this->Fpdf->SetXY(103,250);
                $this->Fpdf->Cell(3,3,'X');
                break;
            case 6: // Pasaporte
                $this->Fpdf->SetXY(113,250);
                $this->Fpdf->Cell(3,3,'X');
                break;
            default: break;
        } 
    }
    $this->Fpdf->SetXY(45,257);
    $this->Fpdf->Cell(33,10,$form['Representative']['identification_number']);

    $this->Fpdf->SetXY(55,232);
    $this->Fpdf->Cell(40,10,$form['Representative']['nationality'],0, 0,'C');
}


// VEHICULO
$vehicle = $form['Vehicle'];

$this->Fpdf->SetXY(160,249);
$this->Fpdf->Cell(33,10,$vehicle['patente'],0,0,'C');

$this->Fpdf->SetXY(150,252);
$this->Fpdf->Cell(33,10,$vehicle['brand'],0,0,'C');

$this->Fpdf->SetXY(150,256);
$this->Fpdf->Cell(33,10,$vehicle['type'],0,0,'C');

$this->Fpdf->SetXY(150,261);
$this->Fpdf->Cell(33,10,$vehicle['model'],0,0,'C');

$this->Fpdf->SetXY(150,265);
$this->Fpdf->Cell(33,10,$vehicle['motor_brand'],0,0,'C');

$this->Fpdf->SetXY(150,269);
$this->Fpdf->Cell(33,10,$vehicle['motor_number'],0,0,'C');

$this->Fpdf->SetXY(150,273);
$this->Fpdf->Cell(33,10,$vehicle['chasis_brand'],0,0,'C');

$this->Fpdf->SetXY(150,277);
$this->Fpdf->Cell(33,10,$vehicle['chasis_number'],0,0,'C');

// debug($this->Fpdf->Pdf);
echo $this->Fpdf->output('page.pdf','i');

