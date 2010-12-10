<?php

App::import('Lib', 'FormSkeleton');

class F08 extends FormSkeleton {
    var $name = 'F08';
   
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $form_id = 6;


    var $involucrados = array('comprador','vendedor', 'condominiocomprador', 'condominiovendedor');


    var $elements = array(
          array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array(
                                'comprador'=>'Comprador',
                                'vendedor'=>'Vendedor',
                                'condominiocomprador'=>'Condominio en la Compra',
                                'condominiovendedor'=>'Condominio en la Venta',
                                ))),
          array('field_forms/character_data'=> array('field_prefix'=>'comprador', 'label'=>'Comprador')),
          array('field_forms/character_data'=> array('field_prefix'=>'condominiocomprador', 'label'=>'Condominio en la Compra')),
          array('field_forms/character_data'=> array('field_prefix'=>'vendedor', 'label'=>'Vendedor')),
          array('field_forms/character_data'=> array('field_prefix'=>'condominiovendedor', 'label'=>'Condominio en la Venta')),
    );

    


    function getFormImputs($data) {
         $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
         $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');
         
        $coso =  array(
            $this->__preformTipo1('comprador'           ,'"D" Comprador o Adquiriente'),
            $this->__preformTipo1('condominiocomprador' ,'"E" Condominio en la Compra o Adquisición'),
            $this->__preformTipo2('vendedor'            ,'"I" Vendedor o Transmitente'),
            $this->__preformTipo2('condominiovendedor'  ,'"J" Condominio en la venta o Transmisión'),
             array(
                'legend'=>'"A"',
                'a_lugar_contrato'=>array('label'=>'Lugar y fecha de celebración del contrato'),
                'a_precio_compra'=>array('label'=>'Precio de compra (en caso de omisión, sucesión, premio, etc. escribir el concepto)'),
                ),
            $this->__vehiclePreform1('"F" Vehículo que se tansfiere'),
            $this->__representativePreform('comprador', '"K" Comprador o Adquiriente'),
            $this->__representativePreform('condominiocomprador', '"L" Condominio en la compra o adquisición'),
            array(
                'legend'=>'"M" Observaciones',
                'observaciones'=>array('label'=>false),
            ),
            array(
                'legend'=>'"H" Deudas y gravámenes declarados por el vendedor',
                'h1_fecha'=>array('label'=>'Fecha de inscripción fila 1'),
                'h1_importe'=>array('label'=>'Importe fila 1'),
                'h1_acreedor'=>array('label'=>'Acreedor fila 1'),
                'h2_fecha'=>array('label'=>'Fecha de inscripción fila 2'),
                'h2_importe'=>array('label'=>'Importe fila 2'),
                'h2_acreedor'=>array('label'=>'Acreedor fila 2'),
            ),
            array(
                'legend'=>'"O"',
                'o_autorizado_name'=>array('label'=>'Autorizo a:'),
                'o_tipo_y_num_doc'=>array('label'=>'Tipo de documento y N°'),
                'o_recibi_tit'=>array('label'=>'recibí título y cédula de identificación'),
            ),
        );


        return $coso;
    }
    
}

?>