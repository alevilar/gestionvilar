<?

//Tipos de output
// I: Send to standard output
// D: Download file
// F: Save to local file
// S: Devolver como un string


$filename = $form_name;
if (!empty($vehicle_domain)) {
    $filename .= '_'.$vehicle_domain;
}

$options = array(
            'debug' => Configure::read('debug'),
            'Printer' => $printer['Printer'],
            'filename' => $filename,
            'output' => 'i',
        );

//debug($pages);die;
echo $this->Fpdf->printPages($pages, $options);
//echo $this->Mpdf->printPages($pages, $options);





