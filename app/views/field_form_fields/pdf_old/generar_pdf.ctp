<?

$options = array(
            'debug' => Configure::read('debug'),
            'Printer' => $printer['Printer'],
            'filename' => $form_name.'_'.$vehicle_domain,
            'output' => 'f',
        );

echo $this->Fpdf->printPages($pages, $options);




