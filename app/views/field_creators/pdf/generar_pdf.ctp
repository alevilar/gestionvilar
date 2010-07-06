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
        $pX = (int)$c['x'] + (int)$printer['Printer']['x'];
        $pY = (int)$c['y'] + (int)$printer['Printer']['y'];
        $this->Fpdf->SetFontSize(floatval($c['fontSize']));
        $this->Fpdf->{$fType}($pX, $pY, $c['value'], $c['w'], $c['h']);
    }
}


if (count($page2)>0) {
    $this->Fpdf->AddPage();

    foreach ($page2 as $f) {
        $c = $f['FieldCoordenate'];
        $fType = $f['FieldType']['name'];
        if (!empty($c['value'])) {
            // adiciono la variacion por la impresra seleccionada
            $pX = (int)$c['x'] + (int)$printer['Printer']['x'];
            $pY = (int)$c['y'] + (int)$printer['Printer']['y'];
            
            $this->Fpdf->SetFontSize(floatval($c['fontSize']));
            $this->Fpdf->{$fType}($pX, $pY, $c['value'], $c['w'], $c['h']);
        }
    }
}

echo $this->Fpdf->output($form_name.'_'.$vehicle_domain.'.pdf','i');