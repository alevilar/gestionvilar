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
                'legend' => '"D" Datos del Automotor',

                         'vehicle_let' => array('label' => 'LET', 'value' => $this->getDatafromField('Vehicle','')),
                         'vehicle_patente' => array('label' => 'Dominio Numero', 'value' => $this->getDatafromField('Vehicle','patente')),
                         'vehicle_dv' => array('label' => 'D.V', 'value' => $this->getDatafromField('Vehicle','')),
                         'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDatafromField('Vehicle','brand')),
                         'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Vehicle','type')),
                         'vehicle_model' => array('label' => 'Modelo', 'value' => $this->getDatafromField('Vehicle','model')),
                         'vehicle_adquisition_anio' => array('label' => 'Año', 'value' => date('Y', strtotime($this->data['Vehicle']['adquisition_date']))),
                         'vehicle_peso' => array('label' => 'Peso', 'value' => $this->getDatafromField('Vehicle','')),
                         'vehicle_fecha' => array('label' => 'Fecha', 'value' => $this->getDatafromField('Vehicle','')),
                         'vehicle_motor_number' => array('label' => 'Motor Numero', 'value' => $this->getDatafromField('Vehicle','motor_number')),
                ),
            array(
                'legend' => '"E" Datos del Titular',

                 'titular_name' => array('label' => 'Apellido y Nombres o Denominacion', 'value' => $this->getDatafromField('Titular','name')),
                 'titular_calle' => array('label' => 'Domicilio Fiscal - Leyenda Calle - Localidad', 'value' => $this->getDatafromField('Titular','calle')),
                 'titular_numero_calle' => array('label' => 'Domicilio Fiscal - Nro. Puerta', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_piso' => array('label' => 'Domicilio Fiscal - Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_depto' => array('label' => 'Domicilio Fiscal - Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 'titular_cp' => array('label' => 'Domicilio Fiscal - Cod. Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_postal_localidad' => array('label' => 'Domicilio Postal - Leyenda Calle - Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                 'titular_postal_numero_calle' => array('label' => 'Domicilio Postal - Nro Puerta', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_postal_piso' => array('label' => 'Domicilio Postal - Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_postal_depto' => array('label' => 'Domicilio Postal - Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 'titular_postal_torre' => array('label' => 'Domicilio Postal - Torre', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_postal_monob' => array('label' => 'Domicilio Postal - Monob.', 'value' => $this->getDatafromField('Titular','')),
                 'titular_postal_nudo' => array('label' => 'Domicilio Postal - Nudo', 'value' => $this->getDatafromField('Titular','')),
                 'titular_postal_tira' => array('label' => 'Domicilio Postal - Tira', 'value' => $this->getDatafromField('Titular','')),
                 'titular_postal_escal' => array('label' => 'Domicilio Postal - Escal.', 'value' => $this->getDatafromField('Titular','')),
                 'titular_postal_cp' => array('label' => 'Domicilio Postal - Cod. Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_identification_type_id' => array('label' => 'Tipo Documento', 'empty' => 'Seleccione', 'options'=> $identificationsTypes, 'value' => $this->getDatafromField('Titular','identification_type_id')),
                 'titular_identification_number' => array('label' => 'Numero Documento', 'value' => $this->getDatafromField('Titular','identification_number')),
                 'titular_cuit_cuil' => array('label' => 'Cuit/Cuil', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
            ),
              
        );


        return $coso;
    }
}