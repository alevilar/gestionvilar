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
            $this->__vehiclePreform1('Vehículo que se tansfiere'),

            array(
                'legend' => 'Titular',
                 'titular_name' => array('label' => 'Apellido y Nombre o Razon Social'),
                 'titular_cuit_cuil' => array('label' => 'Fiscal Doc Identidad N° Personas Juridicas Nu'),
                 'titular_cuit_cuil' => array('label' => 'Fiscal Doc Identidad N° Personas Juridicas Ti'),
                 'titular_cp' => array('label' => 'Fiscal Codigo Postal'),
                 'titular_localidad' => array('label' => 'Fiscal Localidad'),
                 'titular_calle' => array('label' => 'Fiscal Calle'),
                 'titular_numero_calle' => array('label' => 'Fiscal Numero'),
                 'titular_piso' => array('label' => 'Fiscal Piso'),
                 'titular_depto' => array('label' => 'Fiscal Dpto'),
),
	array(
		'legend' => 'Condominio',
                 'condominio_name' => array('label' => 'Apellido y Nombre o Razon Social'),
                 'condominio_cuit_cuil' => array('label' => 'Doc Identidad N° Personas Juridicas Numero'),
                 'condominio_identification_number' => array('label' => 'Doc Identidad N° Personas Juridicas Tipo'),
                 'condominio_cp' => array('label' => 'Codigo Postal'),
                 'condominio_localidad' => array('label' => 'Localidad'),
                 'condominio_calle' => array('label' => 'Calle'),
                 'condominio_numero_calle' => array('label' => 'Numero'),
                 'condominio_piso' => array('label' => 'Piso'),
                 'condominio_depto' => array('label' => 'Dpto'),
           )
        );


        return $coso;
    }
}
