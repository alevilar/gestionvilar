<?
$this->Fpdf->AddPage();


if ($debug_mode) {
    $this->Fpdf->fondoVerde();
    $this->Fpdf->bordeRojo();
} else {
    $this->Fpdf->fondoBlanco();
    $this->Fpdf->bordeBlanco();
}

//debug($page1); die;
// Fuente
$this->Fpdf->SetFont();


foreach ($page1 as $f) {


    $c = $f['FieldCoordenate'];
    $fType = $f['FieldType']['name'];

    if (!empty($c['value'])) {
        $pX = (int)$c['x'] + (int)$printer['Printer']['x'];
        $pY = (int)$c['y'] + (int)$printer['Printer']['y'];
        $this->Fpdf->SetFontSize(floatval($c['font_size']));
        $this->Fpdf->{$fType}($pX, $pY, $c['value'], $c['w'], $c['h']);
    } else {
       // debug($c['value']."<<<<---->".$f['FieldCoordenate']['name']);
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
            
            $this->Fpdf->SetFontSize(floatval($c['font_size']));
            $this->Fpdf->{$fType}($pX, $pY, $c['value'], $c['w'], $c['h']);
        }
    }
}

//
//debug($page1);
//debug($page2);
echo $this->Fpdf->output($form_name.'_'.$vehicle_domain.'.pdf','i');