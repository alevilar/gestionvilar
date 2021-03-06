<?php

App::import('Lib', 'FormSkeleton');


class F01 extends FormSkeleton {


    var $form_id = 1;

    var $involucrados = array('comprador', 'condominiocomprador');

    var $elements = array(
          array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array(
                                'comprador'=>'Titular',
                                'condominiocomprador'=>'Condominio',
                                ))),
          array('field_forms/character_data'=> array('field_prefix'=>'comprador', 'label'=>'Actor Como "Titular"')),
          array('field_forms/character_data'=> array('field_prefix'=>'condominiocomprador', 'label'=>'Actor Como "Condominio"')),
          array('field_forms/representatives_data'=> array('field_prefix'=>'comprador_apoderado','label'=>'Apoderado del Titular')),
          array('field_forms/representatives_data'=> array('field_prefix'=>'condominiocomprador_apoderado','label'=>'Apoderado del Condominio')),
    );

    var $fieldsBlackList = array('created', 'modified', 'vehicle_patente');


    function getFormImputs($data) {
        $this->data = $data;
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
         $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            $this->__preformTipo1('comprador'           ,'Identificación del Titular'),
            $this->__preformTipo1('condominiocomprador' ,'Identificación del Condominio'),
            $this->__vehiclePreform2('Identificación del Automotor'),
            array(
                'legend'=>'+',
                'se_certifica_obs' => array('type'=>'textarea', 'label'=>'Se certifica que las condiciones de indetificación que figuran en esta solicitud fueron verificacas con el certificado de fabricación y con el automotor cuya inscripción se solicita a favor del señor'),
                'texto_fijo' => array('label'=>'Texto Fijo', 'type'=>'textarea', 'value' => 'Si la inscripción del dominio de este automotor se produjera en el año anterior al consignado en el presente certificado de fabricación como modelo-año, regirá a estos efectos el año de su inscripción, tal como lo establece la resolución ex. S.I.M. 416/82 '),
                'comerciante' => array('label'=>'Comerciante Habitualista'),
                 'obervaciones' => array('label'=>'Observaciones', 'type'=>'textarea'),
                 ),
            $this->__representativePreform('comprador', 'Apoderado del Titular'),
            $this->__representativePreform('condominiocomprador', 'Apoderado del Condominio'),
        );
            

        return $coso;
    }


}

?>
