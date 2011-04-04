<?php


App::import('Lib', 'FormSkeleton');


class F13ba extends FormSkeleton {

    var $form_id = 9;

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


    public function beforeSave($options) {
        parent::beforeSave($options);

        $idenTyps = ClassRegistry::init('IdentificationType')->find('list', array('fields'=>array('id','name')));
        foreach ($this->involucrados as $i) {
            if (!empty($this->data[$this->name][$i.'_identification_type_id'])) {
                $iId = $this->data[$this->name][$i.'_identification_type_id'];
                $this->data[$this->name][$i.'_identification_type_name'] = $idenTyps[$iId];
            }
        }

        return true;
    }


    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            array(
                'legend' => 'Datos del Automotor',

                 'vehicle_letra' => array('label' => 'Letra', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->getDatafromField('Vehicle','patente')),
                 'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDatafromField('Vehicle','brand')),
                 'vehicle_model' => array('label' => 'Mod año', 'value' => $this->getDatafromField('Vehicle','model')),
                 'vehicle_modeloanio' => array('label' => 'Mod. Año', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Vehicle','type')),
                 'vehicle_motor_number' => array('label' => 'Número de Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
                 'vehicle_brand' => array('label' => 'Marca del Automotor', 'value' => $this->getDatafromField('Vehicle','brand')),
                 'vehicle_motor_brand' => array('label' => 'Marca del Automotor', 'value' => $this->getDatafromField('Vehicle','motor_brand')),
            ),

            array(
                'legend' => 'Datos del Titular',

                'titular_name' => array('label' => 'Apellido y Nombre o Razón Social', 'value' => $this->getDatafromField('Titular','name')),
                'titular_cuit_cuil' => array('label' => 'Cuit o Cuil', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                'titular_identification_number' => array('label' => 'N° Documento', 'value' => $this->getDatafromField('Titular','identification_number')),
                'titular_identification_type_id' => array('label' => 'Tipo Documento', 'options' => $identificationsTypes, 'empty' => 'Seleccione' ,  'value' => $this->getDatafromField('Titular','')),                 

                'titular_cp' => array('label' => '<hr>Código Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                 'titular_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Titular','calle')),
                 'titular_numero_calle' => array('label' => 'Número', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_depto' => array('label' => 'Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 
                 'titular_postal_cp' => array('label' => '<hr>Postal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_postal_localidad' => array('label' => 'Postal Localidad', 'value' => $this->getDatafromField('Titular','')),
                 'titular_postal_calle' => array('label' => 'Postal Calle', 'value' => $this->getDatafromField('Titular','')),
                 'titular_postal_numero_calle' => array('label' => 'Postal Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_postal_piso' => array('label' => 'Postal Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titulare_postal_depto' => array('label' => 'Postal Dpto', 'value' => $this->getDatafromField('Titular','depto')),

            ),

            array (
                'legend' => 'Identificación de Condominios 1',
                    'condominio_name' => array('label' => 'Apellido y Nombre o Razón Social', 'value' => $this->getDatafromField('Condominio','name')),
                     'condominio_identification_number' => array('label' => 'Doc Identidad n° Personas Juridicas Numero', 'value' => $this->getDatafromField('Condominio','identification_number')),
                     'condominio_identification_type_name' => array('label' => 'Doc Identidad n° Personas Juridicas Tipo', 'value' => $this->getDatafromField('Condominio','identification_type_id')),
                     'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDatafromField('Condominio','cp')),
                     'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Condominio','localidad')),
                     'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Condominio','calle')),
                     'condominio_numero_calle' => array('label' => 'Numero', 'value' => $this->getDatafromField('Condominio','numero_calle')),
                     'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Condominio','piso')),
                     'condominio_depto' => array('label' => 'Depto', 'value' => $this->getDatafromField('Condominio','depto')),
            ),

            array (
                'legend' => 'Identificación de Condominios 2',
                    'condominiocomprador_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Condominiocomprador','name')),
                     'condominiocomprador_identification_number' => array('label' => 'Doc Identidad n° Personas Juridicas Numero', 'value' => $this->getDatafromField('Condominiocomprador','identification_number')),
                     'condominiocomprador_identification_type_name' => array('label' => 'Doc Identidad n° Personas Juridicas Tipo', 'value' => $this->getDatafromField('Condominiocomprador','identification_type_id')),
                     'condominiocomprador_cp' => array('label' => 'postal Codigo Postal', 'value' => $this->getDatafromField('Condominiocomprador','cp')),
                     'condominiocomprador_localidad' => array('label' => 'postal Localidad', 'value' => $this->getDatafromField('Condominiocomprador','localidad')),
                     'condominiocomprador_calle' => array('label' => 'postal Calle', 'value' => $this->getDatafromField('Condominiocomprador','calle')),
                     'condominiocomprador_numero_calle' => array('label' => 'postal Número', 'value' => $this->getDatafromField('Condominiocomprador','numero_calle')),
                     'condominiocomprador_piso' => array('label' => 'postal Piso', 'value' => $this->getDatafromField('Condominiocomprador','piso')),
                     'condominiocomprador_depto' => array('label' => 'postal condominio dpto', 'value' => $this->getDatafromField('Condominiocomprador','depto')),
                         
            ),

                             
        );


        return $coso;
    }
}
