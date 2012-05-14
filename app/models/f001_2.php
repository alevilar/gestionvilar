<?php

App::import('Lib', 'FormSkeleton');


class F001_2 extends FormSkeleton {

    var $form_id = 27;
    
    var $useTable = 'f001_2';

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
         array('field_forms/character_data'=> array('field_prefix'=>'condominio', 'label'=>"Actor Como 'condominio'")),

          array('field_forms/representatives_data'=> array('field_prefix'=>'titular_apoderado','label'=>'Apoderado del Titular')),
          array('field_forms/representatives_data'=> array('field_prefix'=>'condominio_apoderado','label'=>'Apoderado del Condominio')),


         );



    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            $this->__preform2011Tipo1('titular'    ,'Identificación del Titular'),
            $this->__preform2011Tipo1('condominio' ,'Identificación del Condominio'),

            $this->__preformDomicilios('titular'),
            $this->__preformDomicilios('condominio'),
            
            $this->__preformDomicilios('titular', 'real'),
            $this->__preformDomicilios('condominio','real'),

            $this->__vehiclePreform2('Identificación del Automotor'),
            array(
                'legend' => 'Observaciones',
                'obervaciones' => array('label' => null),
                'titular_datoscomplementarios' => array('label' => 'Titular: Datos complementarios'),
                'condominio_datoscomplenentarios' => array('label' => 'Condominio: Datos complementarios'),
            ),

            $this->__representativePreform('titular', 'Apoderado Titular'),
            $this->__representativePreform('condominio', 'Apoderado Condominio'),

            
        );

        return $coso;
    }
}