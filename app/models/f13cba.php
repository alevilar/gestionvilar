<?php

App::import('Lib', 'FormSkeleton');


class F13cba extends FormSkeleton {

    var $form_id = 20;

    var $involucrados = array('titular',
                              'condominio');

    var $elements = array(
         array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array('titular' => 'titular',
                                             'condominio' => 'condominio')
               )
         ),
         array('field_forms/character_data'=> array('field_prefix'=>'titular', 'label'=>"Actor Como 'titular'")),
         array('field_forms/character_data'=> array('field_prefix'=>'condominio', 'label'=>"Actor Como 'condominio'"))
         );



    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(

            array(
                'legend' => 'Vehículo',

                         'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->getDatafromField('Vehicle','patente')),
                         'letra' => array('label' => 'Letra'),
                         'vehicle_number' => array('label' => 'Numero', 'value' => $this->getDatafromField('Vehicle','number')),
                         'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDatafromField('Vehicle','brand')),
                         'vehicle_model' => array('label' => 'Modelo', 'value' => $this->getDatafromField('Vehicle','model')),
                         'vehicle_model' => array('label' => 'Mod Año', 'value' => $this->getDatafromField('Vehicle','model')),
                         'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Vehicle','type')),
                         'vehicle_motor_brand' => array('label' => 'Marca del Automotor', 'value' => $this->getDatafromField('Vehicle','motor_brand')),
                         'vehicle_motor_number' => array('label' => 'Numero de Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
                ),
            array(
                'legend' => 'Titular',
                        'titular_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Titular','name')),
                         'titular_cuit_cuil' => array('label' => 'Fiscal Doc Identidad N° Personas Juridicas Nu', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                         'titular_cuit_cuil' => array('label' => 'Fiscal Doc Identidad N° Personas Juridicas Ti', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                         'titular_cp' => array('label' => 'Fiscal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'Fiscal Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                         'titular_calle' => array('label' => 'Fiscal Calle', 'value' => $this->getDatafromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => 'Fiscal Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Fiscal Piso', 'value' => $this->getDatafromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Fiscal Dpto', 'value' => $this->getDatafromField('Titular','depto')),
            ),
            array(
                'legend' => 'Condominio',
                        'condominio_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Condominio','name')),
                         'condominio_cuit_cuil' => array('label' => 'Doc Identidad N° Personas Juridicas Numero', 'value' => $this->getDatafromField('Condominio','cuit_cuil')),
                         'condominio_identification_number' => array('label' => 'Doc Identidad N° Personas Juridicas Tipo', 'value' => $this->getDatafromField('Condominio','identification_number')),
                         'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDatafromField('Condominio','cp')),
                         'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Condominio','localidad')),
                         'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Condominio','calle')),
                         'condominio_numero_calle' => array('label' => 'Numero', 'value' => $this->getDatafromField('Condominio','numero_calle')),
                         'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Condominio','piso')),
                         'condominio_depto' => array('label' => 'Dpto', 'value' => $this->getDatafromField('Condominio','depto')),
            ),
            array(
                'legend' => '+',
                         'en_fecha' => array('label' => 'En fecha...'),
                         'su_radicacion_a' => array('label' => 'Su Radicacion a.....'),
                         'pcia_de' => array('label' => 'Pcia de...'),
            ),
        );


        return $coso;
    }
}
