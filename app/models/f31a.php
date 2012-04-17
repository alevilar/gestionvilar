<?php

App::import('Lib', 'FormSkeleton');

class F31a extends FormSkeleton {

    var $form_id = 12;

    var $involucrados = array('titular');

    var $elements = array(
         array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array('titular' => 'titular')
               )
         ),
         array('field_forms/character_data'=> array('field_prefix'=>'titular', 'label'=>"Actor Como 'titular'"))
         );

    var $types = array(
            1  => 'Inscripción Inicial',
            2  => 'Subastados y Armados Fuera de Fábrica',
            3  => 'Cambio de radicación',
            4  => 'Recupero de Robo o hurto',
        );


    public function beforeSave($options) {
        parent::beforeSave($options);

        if (!empty($this->data[$this->name]['tipo_tramite_id'])) {
            $numTipo = $this->data[$this->name]['tipo_tramite_id'];
            $this->data[$this->name]['tipo_tramite_'.$numTipo] = 'X';
        }

        return true;
    }


    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');
        
        $coso =  array(

            array(
                'legend'=>'Tipo de Trámite',
                'tipo_tramite_id' => array('options'=>$this->types, 'label'=>'Seleccione tipo de trámite'),
                 ),
             array(
                'legend' => 'Observaciones (reverso)',
                    'observaciones' => array('label' => false,),
                ),
            array(
              'legend' => 'Datos del titular',
                'titular_identification_number' => array('label' => 'Numero', 'value' => $this->getDatafromField('Titular','identification_number')),
                'titular_identification_type_id' => array('label' => 'Tipo Documento', 'options' => $identificationsTypes, 'empty' => 'Seleccione'),
                 'titular_cuit_cuil' => array('label' => 'Numero (para Empresas Nro de C.U.I.T o D.N.R.', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                 'titular_name' => array('label' => 'Apellido y Nombres o Denominacion', 'value' => $this->getDatafromField('Titular','name')),
                 'titular_calle' => array('label' => 'Dom Fiscal. Calle', 'value' => $this->getDatafromField('Titular','calle')),
                 'titular_numero_calle' => array('label' => 'Dom Fiscal. Nro Puerta', 'value' => $this->getDatafromField('Titular','ncalle')),
                 'titular_piso' => array('label' => 'Dom Fiscal. Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_depto' => array('label' => 'Dom Fiscal. Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 'titular_localidad' => array('label' => 'Domicilio Fiscal Localidad Barrio', 'value' => $this->getDatafromField('Titular','localidad')),
                 'titular_cp' => array('label' => 'Dom Fiscal. Cod Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_provincia' => array('label' => 'Domicilio Fiscal Provincia', 'value' => $this->getDatafromField('Titular','provincia')),
                 'titular_dompostal_calle' => array('label' => 'Domicilio Postal - Leyenda Calle - Localidad', 'value' => $this->getDatafromField('Titular','')),
                 'titular_dompostal_numero_calle' => array('label' => 'Domicilio Postal - Nro Puerta', 'value' => $this->getDatafromField('Titular','')),
                 'titular_dompostal_piso' => array('label' => 'Domicilio Postal - Piso', 'value' => $this->getDatafromField('Titular','')),
                 'titular_dompostal_depto' => array('label' => 'Domicilio Postal - Dpto', 'value' => $this->getDatafromField('Titular','')),
                 'titular_dompostal_localidad' => array('label' => 'Domicilio Postal localidad barrio', 'value' => $this->getDatafromField('Titular','')),
                 'titular_dompostal_cp' => array('label' => 'Domicilio Postal - Cod Postal', 'value' => $this->getDatafromField('Titular','')),
                 'titular_dompostal_provincia' => array('label' => 'Domicilio Postal Provincia', 'value' => $this->getDatafromField('Titular','')),
                ),
            array(
              'legend' => 'Datos del Automotor',
                 'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->getDatafromField('Vehicle','patente')),
                 'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDatafromField('Vehicle','brand')),
                 'vehicle_model' => array('label' => 'Modelo', 'value' => $this->getDatafromField('Vehicle','model') ),
                 'vehicle_type' => array('label' => 'Tipo', 'value' => $this->getDatafromField('Vehicle','type')),
                 'vehicle_adquisition_anio' => array('label' => 'Modelo Año', 'value' => date('Y', strtotime($this->data['Vehicle']['adquisition_date'])) ),
                 'vehicle_motor_brand' => array('label' => 'Marca De Motor', 'value' => $this->getDatafromField('Vehicle','motor_brand')),
                 'vehicle_motor_number' => array('label' => 'Numero de Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
                 'vehicle_chasis_brand' => array('label' => 'Marca de Chasis', 'value' => $this->getDatafromField('Vehicle','chasis_brand')),
                 'vehicle_chasis_number' => array('label' => 'Numero de Chasis', 'value' => $this->getDatafromField('Vehicle','chasis_number')),
            ),
        );


        return $coso;
    }
}