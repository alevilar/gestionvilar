<?
//$this->Fpdf->AddPage();


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

$pages = array($page1, $page2);

foreach ($pages as $p) {
    if (count($p)>0) {
        $this->Fpdf->AddPage();
    }
    foreach ($p as $f) {
        meterTexto($f, $printer, &$this);
    }
}

echo $this->Fpdf->output($form_name.'_'.$vehicle_domain.'.pdf','i');








function meterTexto($f, $printer, $vistaObject){
    $c = $f['FieldCoordenate'];
    $fType = $f['FieldType']['name'];

    if (!empty($c['value'])) {
        $pX = (int)$c['x'] + (int)$printer['Printer']['x'];
        $pY = (int)$c['y'] + (int)$printer['Printer']['y'];
        $vistaObject->Fpdf->SetFontSize(floatval($c['font_size']));
        $textoImprimio = $vistaObject->Fpdf->{$fType}($pX, $pY, $c['value'], $c['w'], $c['h']);
        if ($textoImprimio != $c['value'] && !empty($c['FieldCoordenate'])){
            meterTexto($c['FieldCoordenate']);
        }
    } else {
       // debug($c['value']."<<<<---->".$f['FieldCoordenate']['name']);
    }
}