<?php

App::import('Lib', 'FormSkeleton');


class F13caba extends FormSkeleton {

    var $form_id = 18;

    var $involucrados = array('titular');

    var $elements = array(
         array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array('titular' => 'titular')
               )
         ),
         array('field_forms/character_data'=> array('field_prefix'=>'titular', 'label'=>"Actor Como 'titular'"))
         );



    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            array(
                'legend' => '',
                    'LET' => array('label' => 'LET'),
                     'vehicle_patente' => array('label' => 'Dominio Numero', 'value' => $this->data['Vehicle']['patente']),
                     'D_V' => array('label' => 'D.V'),
                ),
             array(
                'legend' => '"D" Datos del Automotor',
                     'vehicle_brand' => array('label' => 'Marca', 'value' => $this->data['Vehicle']['brand']),
                     'vehicle_type' => array('label' => 'Tipo', 'value' => $this->data['Vehicle']['type']),
                     'vehicle_model' => array('label' => 'Modelo', 'value' => $this->data['Vehicle']['model']),
                     'vehicle_adquisition_anio' => array('label' => 'Año', 'value' => $this->data['Vehicle']['patente']),
                     'Peso' => array('label' => 'Peso', 'value' => $this->data['Vehicle']['patente']),
                     'C_A_I_M' => array('label' => 'C.A.I.M'),
                     'Fecha' => array('label' => 'Fecha'),
                     'vehicle_motor_number' => array('label' => 'Motor Numero', 'value' => $this->data['Vehicle']['motor_number']),
            ),
            array(
                'legend' => 'Titular',
                        'titular_name' => array('label' => 'Apellido y Nombres o Denominacion'),
                         'titular_calle' => array('label' => 'Domicilio Fiscal - Leyenda Calle - Localidad'),
                         'titular_numero_calle' => array('label' => 'Domicilio Fiscal - Nro. Puerta'),
                         'titular_piso' => array('label' => 'Domicilio Fiscal - Piso'),
                         'titular_depto' => array('label' => 'Domicilio Fiscal - Dpto'),
                         'titular_cp' => array('label' => 'Domicilio Fiscal - Cod. Postal'),
                         'titular_localidad' => array('label' => 'Domicilio Postal - Leyenda Calle - Localidad'),
                         'titular_numero_calle' => array('label' => 'Domicilio Postal - Nro Puerta'),
                         'titular_piso' => array('label' => 'Domicilio Postal - Piso'),
                         'titular_depto' => array('label' => 'Domicilio Postal - Dpto'),
                         'titular_piso' => array('label' => 'Domicilio Postal - Torre'),
                         'Domicilio_Postal_Monob' => array('label' => 'Domicilio Postal - Monob.'),
                         'Domicilio_Postal_Nudo' => array('label' => 'Domicilio Postal - Nudo'),
                         'Domicilio_Postal_Tira' => array('label' => 'Domicilio Postal - Tira'),
                         'Domicilio_Postal_Escal' => array('label' => 'Domicilio Postal - Escal.'),
                         'titular_cp' => array('label' => 'Domicilio Postal - Cod. Postal'),
                         'titular_identification_dni' => array('label' => 'D.N.I'),
                         'titular_identification_le' => array('label' => 'L.E'),
                         'titular_identification_lc' => array('label' => 'L.C'),
                         'titular_identification_dni_ext' => array('label' => 'Extranjeros D.N.I'),
                         'titular_identification_ci' => array('label' => 'C.I'),
                         'titular_identification_pasap' => array('label' => 'Pasap.'),
                         'titular_identification_number' => array('label' => 'Numero Documento'),
           ), 
		   $this->__vehiclePreform1('Vehículo'),
        );


        return $coso;
    }
}