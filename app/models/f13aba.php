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

     var $selecciones = array(
            'vehicle_primera_inscripcion' => 'Primera Inscripción (vehículo Okm)',
            'vehicle_radicacion_bsas' => 'Radicación en Provincia de Buenos Aires',
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

        if (!empty($this->data[$this->name]['vehicle_seleccion'])) {
            $ky = $this->data[$this->name]['vehicle_seleccion'];
            $this->data[$this->name][$ky] = 'X';
        }

        return true;
    }


    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

       

        $coso =  array(

            array(
                'legend' => 'Datos del Vehículo',

                'vehicle_seleccion' => array('label' => 'Declaración formulada por', 'empty' => 'Seleccione', 'options' => $this->selecciones),
//                 'vehicle_primera_inscripcion' => array('label' => 'Primera Inscripcion (vehiculo Okm)', 'value' => $this->getDatafromField('Vehicle','')),
//                 'vehicle_radicacion_bsas' => array('label' => 'Radicacion en Provincia de Buenos Aires', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_patente' => array('label' => 'Dominio Numero', 'value' => $this->getDatafromField('Vehicle','patente')),
                 'vehicle_brand' => array('label' => 'Marca del Vehiculo', 'value' => $this->getDatafromField('Vehicle','brand')),
                 'vehicle_model' => array('label' => 'Modelo del Vehiculo', 'value' => $this->getDatafromField('Vehicle','model')),
                 'vehicle_aniomodel' => array('label' => 'Mod', 'value' => $this->getDatafromField('Vehicle','aniomodel')),
                 'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Vehicle','type')),
                 'vehicle_use' => array('label' => 'Uso', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_motor_brand' => array('label' => 'Marca del Motor', 'value' => $this->getDatafromField('Vehicle','motor_brand')),
                 'vehicle_motor_number' => array('label' => 'Número del Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
),
            array(
                'legend' => 'Identificación del Contribuyente',

                 'titular_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Titular','name')),
                 'titular_cuit_cuil' => array('label' => 'Cuit o Cuil', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                 'titular_identification_number' => array('label' => 'N° Documento', 'value' => $this->getDatafromField('Titular','identification_number')),
                 'titular_identification_type_id' => array('label' => 'Tipo Documento', 'options'=>$identificationsTypes, 'empty' => 'Seleccione'),
                 'titular_cp' => array('label' => 'Fiscal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_localidad' => array('label' => 'Fiscal Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                 'titular_calle' => array('label' => 'Fiscal Calle', 'value' => $this->getDatafromField('Titular','calle')),
                 'titular_numero_calle' => array('label' => 'Fiscal Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_piso' => array('label' => 'Fiscal Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_depto' => array('label' => 'Fiscal Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 'titular_dompostal_cp' => array('label' => 'Postal Codigo Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_dompostal_localidad' => array('label' => 'Postal Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                 'titular_dompostal_calle' => array('label' => 'Postal Calle', 'value' => $this->getDatafromField('Titular','calle')),
                 'titular_dompostal_numero_calle' => array('label' => 'Postal Numero', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_dompostal_piso' => array('label' => 'Postal Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_dompostal_depto' => array('label' => 'Postal Dpto', 'value' => $this->getDatafromField('Titular','depto')),
            ),

            array(
                'legend' => 'Identificación de Condominios',

                 'condominio_name' => array('label' => 'Apellido y Nombre o Razon Social', 'value' => $this->getDatafromField('Condominio','name')),
                 'condominio_cp' => array('label' => 'Codigo Postal', 'value' => $this->getDatafromField('Condominio','cp')),
                 'condominio_localidad' => array('label' => 'Localidad', 'value' => $this->getDatafromField('Condominio','localidad')),
                 'condominio_calle' => array('label' => 'Calle', 'value' => $this->getDatafromField('Condominio','calle')),
                 'condominio_numero_calle' => array('label' => 'Numero', 'value' => $this->getDatafromField('Condominio','numero_calle')),
                 'condominio_piso' => array('label' => 'Piso', 'value' => $this->getDatafromField('Condominio','piso')),
                 'condominio_depto' => array('label' => 'Dpto', 'value' => $this->getDatafromField('Condominio','depto')),
                 'condominio_identification_number' => array('label' => 'N° Documento', 'value' => $this->getDatafromField('Condominio','identification_number')),
                 'condominio_identification_type_id' => array('label' => 'Tipo Documento', 'options'=>$identificationsTypes, 'empty' => 'Seleccione'),
            ),
           
           
        );


        return $coso;
    }
}