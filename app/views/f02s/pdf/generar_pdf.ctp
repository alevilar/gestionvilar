<?

$form;
$f02types;

//debug($form);die();

$this->Fpdf->AddPage();


if ($debug_mode) {
    $this->Fpdf->fondoVerde();
    $this->Fpdf->bordeRojo();
} else {
    $this->Fpdf->fondoBlanco();
    $this->Fpdf->bordeBlanco();
}

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
$this->Fpdf->SetXY(45,193);
$this->Fpdf->MultiCell(150,10,$form['F02']['declaraciones'],0,'j');



// SOLICITANTE
$this->Fpdf->SetXY(45,210);
$this->Fpdf->Cell(70,5,$form['F02']['solicitante'],0, 0,'C');



// APODERADO
if (!empty($form['Representative'])) {
    $this->Fpdf->SetXY(53,229);
    $this->Fpdf->Cell(65,3,$form['Representative']['surname'].' '.$form['Representative']['name']);

    if ($form['Representative']['nationality_type'] == 'argentino') {
        $this->Fpdf->setIdentificationType(49, 246, $form['Representative']['identification_type_id']);
    } else {
        $this->Fpdf->setIdentificationType(93, 246, $form['Representative']['identification_type_id']);
    }
    $this->Fpdf->SetXY(43,253);
    $this->Fpdf->Cell(30,3,$form['Representative']['identification_number']);

    $this->Fpdf->SetXY(80,253);
    $this->Fpdf->Cell(40,3,$form['Representative']['nationality']);
}


// VEHICULO
$vehicle = $form['Vehicle'];

$this->Fpdf->SetXY(160,245);
$this->Fpdf->Cell(33,3,$vehicle['patente']);

$this->Fpdf->SetXY(150,249);
$this->Fpdf->Cell(33,3,$vehicle['brand']);

$this->Fpdf->SetXY(150,253);
$this->Fpdf->Cell(33,3,$vehicle['type']);

$this->Fpdf->SetXY(150,257);
$this->Fpdf->Cell(33,3,$vehicle['model']);

$this->Fpdf->SetXY(150,261);
$this->Fpdf->Cell(33,3,$vehicle['motor_brand']);

$this->Fpdf->SetXY(150,265);
$this->Fpdf->Cell(33,3,$vehicle['motor_number']);

$this->Fpdf->SetXY(150,269);
$this->Fpdf->Cell(33,3,$vehicle['chasis_brand']);

$this->Fpdf->SetXY(150,273);
$this->Fpdf->Cell(33,3,$vehicle['chasis_number']);






/////////////////////////////////////////////////////////////////////
//     PAGINA 2
/////////////////////////////////////////////////////////////////////


$this->Fpdf->AddPage();


//debug($form);

$customer = $form['Vehicle']['Customer'];
$customer_type = $customer['type'];
$tamLetra = 10;
while ($this->Fpdf->GetStringWidth($customer['name']>70) && $tamLetra > 6) {
    $tamLetra--;
}
$this->Fpdf->SetFont('Courier','',$tamLetra);
$this->Fpdf->SetXY(87, 15);
$this->Fpdf->MultiCell(70,10,$customer['name']);


$this->Fpdf->SetFont('Courier','',10);


if ($customer_type == 'natural') {
    if ($customer['CustomerNatural']['nationality_type']== 'argentino') {
        $this->Fpdf->setIdentificationType(94, 41, $customer['Identification']['identification_type_id']);
        
        //Nro Documento
        $this->Fpdf->SetXY(87,47);
        $this->Fpdf->Cell(29,3,$customer['Identification']['identification_number']);
    } else {
        $this->Fpdf->setIdentificationType(134, 41, $customer['Identification']['identification_type_id']);

         // autoridad o pais que lo expidio
        $this->Fpdf->SetXY(92,47);
        $this->Fpdf->Cell(39,3,$customer['CustomerNatural']['nationality']);
    }
} else {
    // personeria otorgada por
    $this->Fpdf->SetXY(87,55);
    $this->Fpdf->Cell(71,3,$customer['CustomerLegal']['inscription_entity']);

     // n° de datos de creacion
    $this->Fpdf->SetXY(87,62);
    $this->Fpdf->Cell(43,3,$customer['CustomerLegal']['inscription_number']);

    // n° de datos de creacion
    $this->Fpdf->cellDate(133,62,$customer['born']);
}


echo $this->Fpdf->output('f02_'.$form['F02']['solicitante'].'.pdf','i');

