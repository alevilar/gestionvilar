<?
$this->Fpdf->AddPage();


if ($debug_mode) {
    $this->Fpdf->fondoVerde();
    $this->Fpdf->bordeRojo();
} else {
    $this->Fpdf->fondoBlanco();
    $this->Fpdf->bordeBlanco();
}


// Fuente
$this->Fpdf->SetFont();



foreach ($page1 as $f) {


    $c = $f['FieldCoordenate'];
    $fType = $f['FieldType']['name'];

    if (!empty($c['value'])) {
        $this->Fpdf->{$fType}($c['x'], $c['y'], $c['value'], $c['w'], $c['h']);
    }
}


if (count($page2)>0) {
    $this->Fpdf->AddPage();

    foreach ($page2 as $f) {
        $c = $f['FieldCoordenate'];
        $fType = $f['FieldType']['name'];

        if (!empty($c['value'])) {
            $this->Fpdf->SetFontSize($c['fontSize']);
            $this->Fpdf->{$fType}($c['x'], $c['y'], $c['value'], $c['w'], $c['h']);
        }
    }
}

//die("vista");


echo $this->Fpdf->output($form_name.'_'.$vehicle_domain.'.pdf','i');