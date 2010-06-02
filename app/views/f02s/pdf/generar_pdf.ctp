<?

$form;
$f02types;

//debug($form);die();


// PATENTE
$this->Fpdf->SetFont('Courier','B',12);
$this->Fpdf->SetXY('90','43');
$this->Fpdf->Cell(30,6,$form['Vehicle']['patente']);


// SOLICITUD DE:
$this->Fpdf->SetFont('Courier','',8);
switch ($form['F02']['type']) {
    case 0:  $this->Fpdf->SetXY('46','67');
        break;
    case 1:  $this->Fpdf->SetXY('46','76');
        break;
    case 2:  $this->Fpdf->SetXY('46','85');
        break;
    case 3:  $this->Fpdf->SetXY('46','91');
        break;
    case 4:  $this->Fpdf->SetXY('46','99');
        break;
    case 5:  $this->Fpdf->SetXY('46','105');
        break;
    case 6:  $this->Fpdf->SetXY('46','114');
        break;
    case 7:  $this->Fpdf->SetXY('46','118');
        break;
    case 8:  $this->Fpdf->SetXY('46','122');
        break;
    case 9:  $this->Fpdf->SetXY('46','128');
        break;
    case 10: $this->Fpdf->SetXY('46','132');
        break;
    case 11: $this->Fpdf->SetXY('46','135');
        break;
    case 12: $this->Fpdf->SetXY('46','141');
        break;
    case 13: $this->Fpdf->SetXY('46','147');
        break;
    case 14: $this->Fpdf->SetXY('46','153');
        break;
    case 15: $this->Fpdf->SetXY('46','160');
        break;
    case 16: $this->Fpdf->SetXY('46','165');
        break;
    case 17: $this->Fpdf->SetXY('46','171');
        break;
    case 18: $this->Fpdf->SetXY('46','175');
        break;
    case 19: $this->Fpdf->SetXY('46','181');
        break;
    default: break;
}
$this->Fpdf->Cell(3,3,'X',1,'','C',1);



// DECLARACIONES
$this->Fpdf->SetXY(45,190);
$this->Fpdf->MultiCell(150,4,$form['F02']['declaraciones'],0,'j');



// SOLICITANTE
$this->Fpdf->SetXY(45,212);
$this->Fpdf->Cell(70,5,$form['F02']['solicitante'],0, 0,'C');



// APODERADO
if (!empty($form['Representative'])) {
    $nom = $form['Representative']['surname'].' '.$form['Representative']['name'];
    if (!empty($form['Representative']['surname'])) {
        $this->Fpdf->SetXY(53,231);
        $this->Fpdf->Cell(65,3,$nom);

        if ($form['Representative']['nationality_type'] == 'argentino') {
            $this->Fpdf->setIdentificationType(49, 248, $form['Representative']['identification_type_id']);
        } else {
            $this->Fpdf->setIdentificationType(93, 248, $form['Representative']['identification_type_id']);
        }
        $this->Fpdf->SetXY(43,255);
        $this->Fpdf->Cell(30,3,$form['Representative']['identification_number']);

        $this->Fpdf->SetXY(80,255);
        $this->Fpdf->Cell(40,3,$form['Representative']['nationality']);
    }
}


// VEHICULO
$vehicle = $form['Vehicle'];

$this->Fpdf->Text(160,250,$vehicle['patente']);

$this->Fpdf->Text(150,254,$vehicle['brand']);

$this->Fpdf->Text(150,258,$vehicle['type']);

$this->Fpdf->Text(150,262,$vehicle['model']);

$this->Fpdf->Text(150,266,$vehicle['motor_brand']);

$this->Fpdf->Text(150,270,$vehicle['motor_number']);

$this->Fpdf->Text(150,274,$vehicle['chasis_brand']);

//$this->Fpdf->SetXY(150,277);
$this->Fpdf->Text(150,278,$vehicle['chasis_number']);






/////////////////////////////////////////////////////////////////////
//     PAGINA 2
/////////////////////////////////////////////////////////////////////

if (!empty($form['F02']['description'])) {
    $this->Fpdf->AddPage();

    $this->Fpdf->SetXY(45,220);
    $this->Fpdf->MultiCell(115, 9, $form['F02']['description']);
}



