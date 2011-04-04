<?

$options = array(
            'debug' => Configure::read('debug'),
            'Printer' => $printer['Printer'],
            'filename' => $form_name.'_'.$vehicle_domain,
            //'output' => 's',
        );

//debug($pages);die;
echo $this->Fpdf->printPages($pages, $options);
//echo $this->Mpdf->printPages($pages, $options);





