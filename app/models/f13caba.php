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
                'legend' => '+',
                         'vehicle_id' => array('type'=>'hidden'),
                         'let' => array('label' => 'LET'),
                         'vehicle_patente' => array('label' => 'Dominio Numero', 'value' => $this->getDataFromField('Vehicle','patente')),
                         'd_v' => array('label' => 'D.V'),
                ),
             array(
                'legend' => '"D" Datos del Automotor',
                         'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDataFromField('Vehicle','brand')),
                         'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDataFromField('Vehicle','type')),
                         'vehicle_model' => array('label' => 'Modelo', 'value' => $this->getDataFromField('Vehicle','model')),
                         'vehicle_adquisition_anio' => array('label' => 'Año', 'value' => $this->getDataFromField('Vehicle','adquisition_anio')),
                         'peso' => array('label' => 'Peso'),
                         'c_a_i_m' => array('label' => 'C.A.I.M'),
                         'fecha' => array('label' => 'Fecha'),
                         'vehicle_motor_number' => array('label' => 'Motor Numero', 'value' => $this->getDataFromField('Vehicle','motor_number')),
            ),
            array(
                'legend' => 'Titular',
                        'titular_name' => array('label' => 'Apellido y Nombres o Denominacion', 'value' => $this->getDataFromField('Titular','name')),
                         'titular_calle' => array('label' => 'Domicilio Fiscal - Leyenda Calle - Localidad', 'value' => $this->getDataFromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => 'Domicilio Fiscal - Nro. Puerta', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Domicilio Fiscal - Piso', 'value' => $this->getDataFromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Domicilio Fiscal - Dpto', 'value' => $this->getDataFromField('Titular','depto')),
                         'titular_cp' => array('label' => 'Domicilio Fiscal - Cod. Postal', 'value' => $this->getDataFromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'Domicilio Postal - Leyenda Calle - Localidad', 'value' => $this->getDataFromField('Titular','localidad')),
                         'titular_numero_calle' => array('label' => 'Domicilio Postal - Nro Puerta', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Domicilio Postal - Piso', 'value' => $this->getDataFromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Domicilio Postal - Dpto', 'value' => $this->getDataFromField('Titular','depto')),
                         'titular_piso' => array('label' => 'Domicilio Postal - Torre', 'value' => $this->getDataFromField('Titular','piso')),
                         'domicilio_postal_monob' => array('label' => 'Domicilio Postal - Monob.'),
                         'domicilio_postal_nudo' => array('label' => 'Domicilio Postal - Nudo'),
                         'domicilio_postal_tira' => array('label' => 'Domicilio Postal - Tira'),
                         'domicilio_postal_escal' => array('label' => 'Domicilio Postal - Escal.'),
                         'titular_cp' => array('label' => 'Domicilio Postal - Cod. Postal', 'value' => $this->getDataFromField('Titular','cp')),
                         'titular_identification_type_id' => array('label' => 'D.N.I', 'options' => $identificationsTypes, 'empty' => 'Seleccione'),
//                         'titular_identification_dni' => array('label' => 'D.N.I', 'value' => $this->getDataFromField('Titular','identification_dni')),
//                         'titular_identification_le' => array('label' => 'L.E', 'value' => $this->getDataFromField('Titular','identification_le')),
//                         'titular_identification_lc' => array('label' => 'L.C', 'value' => $this->getDataFromField('Titular','identification_lc')),
//                         'titular_identification_dni_ext' => array('label' => 'Extranjeros D.N.I', 'value' => $this->getDataFromField('Titular','identification_dni_ext')),
//                         'titular_identification_ci' => array('label' => 'C.I', 'value' => $this->getDataFromField('Titular','identification_ci')),
//                         'titular_identification_pasap' => array('label' => 'Pasap.', 'value' => $this->getDataFromField('Titular','identification_pasap')),
                         'titular_identification_number' => array('label' => 'Numero Documento', 'value' => $this->getDataFromField('Titular','identification_number')),
           ), 
        );


        return $coso;
    }
}




