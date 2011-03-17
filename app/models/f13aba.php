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

           array(
                'legend' => 'Vehículo',
                         'radicacion_en_provincia_de_buenos_aires_prove' => array('label' => 'Radicacion en Provincia de Buenos Aires Prove'),
                         'dominio_letra' => array('label' => 'Dominio Letra'),
                         'vehicle_patente' => array('label' => 'Dominio Numero', 'value' => $this->getDatafromField('Vehicle','patente')),
                         'categ_fiscal' => array('label' => 'Categ. Fiscal'),
                         'inciso' => array('label' => 'Inciso'),
                         'vehicle_brand' => array('label' => 'Marca del Vehiculo', 'value' => $this->getDatafromField('Vehicle','brand')),
                         'vehicle_model' => array('label' => 'Modelo del Vehiculo', 'value' => $this->getDatafromField('Vehicle','model')),
                         'vehicle_model' => array('label' => 'Mod', 'value' => $this->getDatafromField('Vehicle','model')),
                         'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Vehicle','type')),
                         'uso' => array('label' => 'Uso'),
                         'nac' => array('label' => 'Nac'),
                         'peso_o_tara_kg' => array('label' => 'Peso o Tara (kg)'),
                         'carga_maxima' => array('label' => 'Carga Maxima'),
                         'vehicle_motor_brand' => array('label' => 'Marca del Motor', 'value' => $this->getDatafromField('Vehicle','motor_brand')),
                         'vehicle_motor_number' => array('label' => 'Numero del Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
                         'combustible' => array('label' => 'Combustible'),
),

		array(
                 'legend' => 'Titular',
                     'primera_inscripcion_vehiculo_okm' => array('label' => 'Primera Inscripcion (vehiculo Okm)'),

                         'titular_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Titular','name')),
                         'titular_identification_number' => array('label' => 'Doc Identidad N° Personas Juridicas Numero', 'value' => $this->getDatafromField('Titular','identification_number')),
                         'titular_identification_type_id' => array('label' => 'Doc Identidad N° Personas Juridicas Tipo', 'value' => $this->getDatafromField('Titular','identification_type_id'), 'options'=> $identificationsTypes),
                         'titular_cp' => array('label' => 'Fiscal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'Fiscal Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                         'titular_calle' => array('label' => 'Fiscal Calle', 'value' => $this->getDatafromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => 'Fiscal Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Fiscal Piso', 'value' => $this->getDatafromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Fiscal Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                         'titular_cp' => array('label' => 'Postal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'Postal Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                         'titular_calle' => array('label' => 'Postal Calle', 'value' => $this->getDatafromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => 'Postal Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Postal Piso', 'value' => $this->getDatafromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Postal Dpto', 'value' => $this->getDatafromField('Titular','depto')),
		),
		array(
		'legend' => 'Condominio',
                         'condominio_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Condominio','name')),
                         'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDatafromField('Condominio','cp')),
                         'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Condominio','localidad')),
                         'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Condominio','calle')),
                         'condominio_numero_calle' => array('label' => 'Numero', 'value' => $this->getDatafromField('Condominio','numero_calle')),
                         'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Condominio','piso')),
                         'condominio_depto' => array('label' => 'Dpto', 'value' => $this->getDatafromField('Condominio','depto')),
                         'doc_identidad_n_personas_juridicas_numero' => array('label' => 'Doc. Identidad N° personas juridicas numero'),
                         'condominio_identification_number' => array('label' => 'Doc. Identidad N° personas juridicas tipo', 'value' => $this->getDatafromField('Condominio','identification_number')),
           ),
        );


        return $coso;
    }
}

