<?php

App::import('Lib', 'FormSkeleton');


class F11 extends FormSkeleton {
   


    var $belongsTo = array('Vehicle', 'Representative', 'Spouse');

    // Id del Formulario
    var $form_id = 7;


    var $elements = array(
            'field_forms/spouses_data'=> array('label'=>'Cónyuge o su Apoderado'),
            'field_forms/representatives_data'=> array(),
    );



    public function beforeSave($options) {
        parent::beforeSave($options);
        if (!empty($this->data[$this->name]['es_entrega'])) {
            // si es 1 es posesion
            // si es 2 es tenencia
            if ($this->data[$this->name]['es_entrega'] == 2) {
                $this->data[$this->name]['entrega_tenencia'] = 'X';
            } elseif($this->data[$this->name]['es_entrega'] == 1) {
                $this->data[$this->name]['entrega_posesion'] = 'X';
            }

        }

        switch ($this->data[$this->name]['vendedor_marital_status_id']) {
            case 1: // Casado
                $this->data[$this->name]['vendedor_casado'] = 'X';
                break;
            case 2: //Soltero
                $this->data[$this->name]['vendedor_soltero'] = 'X';
                break;
            case 3: // Viudo
                $this->data[$this->name]['vendedor_viudo'] = 'X';
                break;
            case 4 : // DIvorciado
                $this->data[$this->name]['vendedor_divorciado'] = 'X';
                break;
        }


        switch ($this->data[$this->name]['representative_identification_type_id']) {
            case 1: //DNI
                $this->data[$this->name]['representative_identification_dni'] = 'X';
                breaK;
            case 6: // Pasaporte
                $this->data[$this->name]['representative_identification_pasap'] = 'X';
                breaK;
            case 3: // LE
                $this->data[$this->name]['representative_identification_le'] = 'X';
                breaK;
            case 4: // LC
                $this->data[$this->name]['representative_identification_lc'] = 'X';
                breaK;
            case 5: // CI
                $this->data[$this->name]['representative_identification_ci'] = 'X';
                breaK;
        }


        switch ($this->data[$this->name]['spouse_identification_type_id']) {
            case 1: //DNI
                $this->data[$this->name]['spouse_identification_dni'] = 'X';
                breaK;
            case 6: // Pasaporte
                $this->data[$this->name]['spouse_identification_pasap'] = 'X';
                breaK;
            case 3: // LE
                $this->data[$this->name]['spouse_identification_le'] = 'X';
                breaK;
            case 4: // LC
                $this->data[$this->name]['spouse_identification_lc'] = 'X';
                breaK;
            case 5: // CI
                $this->data[$this->name]['spouse_identification_ci'] = 'X';
                breaK;
        }

        //debug($this->data);die();

        return true;

    }



    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $customerMaritalStatus = '';
        $customerNuptials = '';
        if ($data['Vehicle']['Customer']['type'] == 'natural' && !empty($data['Vehicle']['Customer']['CustomerNatural'])) {
            $customerMaritalStatus = $data['Vehicle']['Customer']['CustomerNatural']['marital_status_id'];
            $customerNuptials = $data['Vehicle']['Customer']['CustomerNatural']['nuptials'];
        }

        return array(
                array(
                        'legend'=>'Dominio',
                        'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                        'vehicle_patente'=>array('label'=>'N° de Chapa Patente', 'value'=>$data['Vehicle']['patente'] ),
                ),
                array(
                        'legend'=>'Vendedor o Transmitente',
                        'vendedor_name'=> array('label'=> 'Apellido y Nombres o Denominación del Vendedor', 'value'=>$data['Vehicle']['Customer']['name'], 'class'=>'span-11 clear'),
                        'vendedor_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione', 'value'=>$customerMaritalStatus),
                        'vendedor_nuptials'=> array('div'=>array('class'=>'span-3 clear'), 'class'=>'span-1', 'label'=>'Nupcia N°','value'=>$customerNuptials),
                ),
                array(
                        'legend'=>false,
                        'datos'=>array('label'=>'Indicar datos del comprados o adquiriente y lugar de entega del vehiculo. Si no la recuerda, fecha anticipada'),
                ),
                array(
                        'legend'=>'Apoderado',
                        'representative_name' => array('label'=>'Nombre'),
                        'representative_identification_type_id'=> array('label'=>'Tipo Documento', 'options'=>$identificationsTypes, 'empty'=>'Seleccione'),
                        'representative_identification_number' => array('label'=>'N° Documento'),
                        'representative_nationality' => array('label'=>'Autoridad (o Pais) que lo expidió'),
                        'representative_fecha_firma' => array('label'=>'Fecha (para el sello y firma del certificante)'),
                ),
                array(
                        'legend'=>false,
                        'es_entrega'=>array(
                                'label'=>'Si no se tratara de una venta seleccionar lo que corresponda',
                                'options'=>array('Seleccione','Entrega de Posesión','Entrega de Tenencia'),
                        ),
                ),
                array(
                        'legend'=>'Cónyuge',
                        'conyuge_name' => array('label'=>'Apellido y Nombre del cónyuge del vendedor o transmitente'),
                        'spouse_name' => array('label'=>'Apellido y Nombre del Apoderado del Cónyuge'),
                        'spouse_identification_type_id'=> array('label'=>'Tipo Documento', 'options'=>$identificationsTypes, 'empty'=>'Seleccione'),
                        'spouse_identification_number'=> array('label'=>'N° DOcumento'),
                        'spouse_identification_autority'=> array('label'=>'Autoridad (o País) que lo expidió'),
                        'spouse_identification_fecha_firma'=> array('label'=>'Fecha (para el sello y firma del certificante)'),
                ),
        );
    }



    public function getViewVars() {
        parent::getViewVars();

        // Get Spouses
        $spouses = array();
        if (!empty($this->data['Vehicle']['Customer']['CustomerNatural']['id'])) {
            $spouses = ClassRegistry::init('Spouse')->find('all',array(
                    'conditions'=>array('customer_natural_id'=>$this->data['Vehicle']['Customer']['CustomerNatural']['id']),
                    'recursive'=>-1,
            ));
        }
        $finalSpouses = array();
        foreach($spouses as $sp) {
            $finalSpouses[$sp['Spouse']['id']] = array(
                    'text'=>$sp['Spouse']['name'],
                    'json'=>json_encode($sp['Spouse']),
            );
        }

        // Get Representatives
        $representatives = array();
        if (!empty($this->data['Vehicle']['Customer']['id'])) {
            $representatives = ClassRegistry::init('Representative')->find('all',array(
                    'conditions'=>array('customer_id'=>$this->data['Vehicle']['Customer']['id']),
                    'recursive'=>-1,
            ));
        }
        $finalRepresentatives = array();
        foreach($representatives as $rp) {
            $finalRepresentatives[$rp['Representative']['id']] = array(
                    'text'=>$rp['Representative']['name'],
                    'json'=>json_encode($rp['Representative']),
            );
        }

        return array(
                'spouses'=>$finalSpouses,
                'representatives'=> $finalRepresentatives,
        );
    }
}

?>
