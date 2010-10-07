<?php

App::import('Lib', 'FormSkeleton');


class F01 extends FormSkeleton {
    var $validate = array(
            'vehicle_id' => array(
                            'notempty' => array(
                                            'rule' => array('notempty'),
                                            'message' => 'Debe seleccionar un valor.',
                            ),
                            'numeric' => array(
                                            'rule' => array('numeric'),
                                            'message'=>'Debe ingresar una valor numérico en este campo'
                            ),
            ),
    );


    var $belongsTo = array('Vehicle','Character','Spouse', 'Representative');

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
    );



    function getFormImputs($data) {
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
                 'obervaciones' => array('label'=>'Observaciones', 'type'=>'textarea'),
                 ),
            $this->__representativePreform('comprador', 'Apoderado del Titular'),
            $this->__representativePreform('condominiocomprador', 'Apoderado del Condominio'),
        );
            

        return $coso;
    }


}

?>
