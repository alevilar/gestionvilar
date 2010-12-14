<?php

App::import('Lib', 'FormSkeleton');

class F13ba extends FormSkeleton
{

    var $form_id = 9;
    var $involucrados = array('titular',
        'condominio');
    var $elements = array(
        array('field_forms/customer_to_character' => array(
                'label' => 'El Cliente es',
                'options' => array('titular' => 'titular',
                    'condominio' => 'condominio')
            )
        ),
        array('field_forms/character_data' => array('field_prefix' => 'titular', 'label' => "Actor Como 'titular'")),
        array('field_forms/character_data' => array('field_prefix' => 'condominio', 'label' => "Actor Como 'condominio'"))
    );

    function getFormImputs($data)
    {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso = array(
            array(
                'legend' => 'Titular',


                'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->getDataFromField('Vehicle','patente')),
                         'titular_name' => array('label' => 'Apellido y Nombre o Razón Social', 'value' => $this->getDataFromField('Titular','name')),
                         'titular_cuit_cuil' => array('label' => 'Doc. Identidad - N° Personas Jurídica Numero', 'value' => $this->getDataFromField('Titular','cuit_cuil')),
                         'titular_cp' => array('label' => 'Código Postal', 'value' => $this->getDataFromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'Localidad', 'value' => $this->getDataFromField('Titular','localidad')),
                         'letra' => array('label' => 'Letra'),
                         'titular_numero_calle' => array('label' => 'Numero', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_cuit_cuil' => array('label' => 'Doc. Identidad - N° Personas Jurídicas - tipo', 'value' => $this->getDataFromField('Titular','')),
                         'titular_calle' => array('label' => 'Calle', 'value' => $this->getDataFromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => 'Numero', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Piso', 'value' => $this->getDataFromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Dpto', 'value' => $this->getDataFromField('Titular','depto')),
                         'titular_cp' => array('label' => 'postal Codigo Postal', 'value' => $this->getDataFromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'postal Localidad', 'value' => $this->getDataFromField('Titular','')),
                         'postal_calle' => array('label' => 'postal Calle'),
                         'titular_numero_calle' => array('label' => 'postal Numero', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'postal Piso', 'value' => $this->getDataFromField('Titular','piso')),
                         'titular_depto' => array('label' => 'postal Dpto', 'value' => $this->getDataFromField('Titular','depto')),
            ),
            array(
                'legend' => 'Condominio',
                'condominio_name' => array('label' => 'Apellido y Nombre o Razón Social', 'value' => $this->getDataFromField('Condominio','name')),
                         'condominio_cuit_cuil' => array('label' => 'Doc Identidad n° Personas Juridicas Numero', 'value' => $this->getDataFromField('Condominio','cuit_cuil')),
                         'condominio_identification_number' => array('label' => 'Doc Identidad n° Personas Juridicas Tipo', 'value' => $this->getDataFromField('Condominio','identification_number')),
                         'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDataFromField('Condominio','cp')),
                         'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDataFromField('Condominio','localidad')),
                         'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDataFromField('Condominio','calle')),
                         'condominio_numero_calle' => array('label' => 'Numero', 'value' => $this->getDataFromField('Condominio','numero_calle')),
                         'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDataFromField('Condominio','piso')),
                         'condominio_depto' => array('label' => 'Depto', 'value' => $this->getDataFromField('Condominio','depto')),
                         'condominio_name' => array('label' => '2 Apellido y Nombre o Razon Social', 'value' => $this->getDataFromField('Condominio','name')),
                         'condominio_cuit_cuil' => array('label' => '2 Doc Identidad n° Personas Juridicas Numero', 'value' => $this->getDataFromField('Condominio','cuit_cuil')),
                         'condominio_identification_type_id' => array('label' => '2 Doc Identidad n° Personas Juridicas Tipo', 'value' => $this->getDataFromField('Condominio','identification_type_id')),
                         'condominio_cp' => array('label' => '2 Codigo Postal', 'value' => $this->getDataFromField('Condominio','cp')),
                         'condominio_localidad' => array('label' => '2 Localidad', 'value' => $this->getDataFromField('Condominio','localidad')),
                         'condominio_calle' => array('label' => '2 Calle', 'value' => $this->getDataFromField('Condominio','calle')),
                         'condominio_numero_calle' => array('label' => '2 Numero', 'value' => $this->getDataFromField('Condominio','numero_calle')),
                         'condominio_piso' => array('label' => '2 Piso', 'value' => $this->getDataFromField('Condominio','piso')),
                         'condominio_1_dpto' => array('label' => 'condominio 1 dpto'),
            ),
            array(
                'legend' => 'Vehículo',
                        'vehicle_brand' => array('label' => 'Marca del Automotor', 'value' => $this->getDataFromField('Vehicle','brand')),
                        'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDataFromField('Vehicle','brand')),
                         'vehicle_model' => array('label' => 'Mod año', 'value' => $this->getDataFromField('Vehicle','model')),
                         'titular_type' => array('label' => 'Tipo', 'value' => $this->getDataFromField('Titular','type')),
                         'vehicle_motor_number' => array('label' => 'Número de Motor', 'value' => $this->getDataFromField('Vehicle','motor_number')),
                         'modelo' => array('label' => 'Modelo'),
            ),
        );


        return $coso;
    }

}
