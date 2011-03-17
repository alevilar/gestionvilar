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
                         'titular_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Titular','type')),                         
                         'titular_name' => array('label' => 'Apellido y Nombre o Razón Social', 'value' => $this->getDatafromField('Titular','name')),
                         'titular_cuit_cuil' => array('label' => 'Doc. Identidad y N° Personas Fisicas', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                         'titular_cp' => array('label' => 'Código Postal', 'value' => $this->getDatafromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                         'letra' => array('label' => 'Letra'),
                         'titular_numero_calle' => array('label' => 'Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),           
                         'titular_tipo_y_numero_doc' => array('label' => 'Doc. Identidad - N° Personas Jurídicas - tipo'),
                         'titular_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => 'Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                         'titular_cp' => array('label' => 'postal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                         'titular_localidad' => array('label' => 'postal Localidad', 'value' => $this->getDatafromField('Titular','')),
                         'postal_calle' => array('label' => 'postal Calle'),
                         'titular_numero_calle' => array('label' => 'postal Numero', 'value' => $this->getDatafromField('Titular','')),
                         'titular_piso' => array('label' => 'postal Piso', 'value' => $this->getDatafromField('Titular','')),
                         'titular_depto' => array('label' => 'postal Dpto', 'value' => $this->getDatafromField('Titular','')),                        
                         'modelo' => array('label' => 'Modelo'),
                         'titular_cuit_cuil' => array('label' => 'Cuit y numero personas juridicas', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
           ),
                array(
                    'legend' => 'Condominio',
                     'condominio_name' => array('label' => 'Apellido y Nombre o Razón Social', 'value' => $this->getDatafromField('Condominio','name')),
                         'condominio_cuit_cuil' => array('label' => 'Doc Identidad n° Personas Juridicas Numero', 'value' => $this->getDatafromField('Condominio','cuit_cuil')),
                         'condominio_identification_number' => array('label' => 'Doc Identidad n° Personas Juridicas Tipo', 'value' => $this->getDatafromField('Condominio','identification_number')),
                         'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDatafromField('Condominio','cp')),
                         'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Condominio','localidad')),
                         'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Condominio','calle')),
                         'condominio_numero_calle' => array('label' => 'Número', 'value' => $this->getDatafromField('Condominio','numero_calle')),
                         'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Condominio','piso')),
                         'condominio_depto' => array('label' => 'Depto', 'value' => $this->getDatafromField('Condominio','depto')),
                         'condominio_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Condominio','name')),
                         'condominio_cuit_cuil' => array('label' => 'Doc Identidad n° Personas Juridicas Numero', 'value' => $this->getDatafromField('Condominio','cuit_cuil')),
                         'condominio_identification_type_id' => array('label' => 'Doc Identidad n° Personas Juridicas Tipo', 'value' => $this->getDatafromField('Condominio','identification_type_id')),
                         'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDatafromField('Condominio','cp')),
                         'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Condominio','localidad')),
                         'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Condominio','calle')),
                         'condominio_numero_calle' => array('label' => 'Número', 'value' => $this->getDatafromField('Condominio','numero_calle')),
                         'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Condominio','piso')),
                         'condominio_1_dpto' => array('label' => 'condominio 1 dpto'),
                ),
             array(
                'legend' => 'Vehículo',
                 'vehicle_id' => array('type'=>'hidden'),
                'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->getDatafromField('Vehicle','patente')),
                         'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDatafromField('Vehicle','brand')),
                         'vehicle_model' => array('label' => 'Mod año', 'value' => $this->getDatafromField('Vehicle','model')),
                        'vehicle_motor_number' => array('label' => 'Número de Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
                'vehicle_brand' => array('label' => 'Marca del Automotor', 'value' => $this->getDatafromField('Vehicle','brand')),
            ),
      );

        return $coso;
    }

}
