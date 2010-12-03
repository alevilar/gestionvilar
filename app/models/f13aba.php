<?php

App::import('Lib', 'FormSkeleton');


class F13aba extends FormSkeleton {

    var $form_id = 19;

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

            // EJEMPLOS
$this->__vehiclePreform1('Vehículo'),
/*
           array(
                'legend' => 'Vehículo',

                 'vehicle_patente' => array('label' => 'Dominio Numero'),
                 'vehicle_brand' => array('label' => 'Marca del Vehiculo'),
                 'vehicle_model' => array('label' => 'Modelo del Vehiculo'),
                 'vehicle_model' => array('label' => 'Mod'),
                 'vehicle_type' => array('label' => 'Tipo'),
                 'vehicle_motor_brand' => array('label' => 'Marca del Motor'),
                 'vehicle_motor_number' => array('label' => 'Numero del Motor'),
),
*/
		array(
                 'legend' => 'Titular',
                 'titular_name' => array('label' => 'Apellido y Nombre o Razon Social'),
                 'titular_identification_number' => array('label' => 'Doc Identidad N° Personas Juridicas Numero'),
                 'titular_identification_type_id' => array('label' => 'Doc Identidad N° Personas Juridicas Tipo'),
                 'titular_cp' => array('label' => 'Fiscal Codigo Postal'),
                 'titular_localidad' => array('label' => 'Fiscal Localidad'),
                 'titular_calle' => array('label' => 'Fiscal Calle'),
                 'titular_numero_calle' => array('label' => 'Fiscal Numero'),
                 'titular_piso' => array('label' => 'Fiscal Piso'),
                 'titular_depto' => array('label' => 'Fiscal Dpto'),
                 'titular_cp' => array('label' => 'Postal Codigo Postal'),
                 'titular_localidad' => array('label' => 'Postal Localidad'),
                 'titular_calle' => array('label' => 'Postal Calle'),
                 'titular_numero_calle' => array('label' => 'Postal Numero'),
                 'titular_piso' => array('label' => 'Postal Piso'),
                 'titular_depto' => array('label' => 'Postal Dpto'),
		),
		array(
		'legend' => 'Condominio',
                 'condominio_name' => array('label' => 'Apellido y Nombre o Razon Social'),
                 'condominio_cp' => array('label' => 'Codigo Postal'),
                 'condominio_localidad' => array('label' => 'Localidad'),
                 'condominio_calle' => array('label' => 'Calle'),
                 'condominio_numero_calle' => array('label' => 'Numero'),
                 'condominio_piso' => array('label' => 'Piso'),
                 'condominio_depto' => array('label' => 'Dpto'),
           ),
        );


        return $coso;
    }
}

