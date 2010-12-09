<?php
App::import('Lib', 'FormSkeleton');


class F03 extends FormSkeleton {
    var $name = 'F03';
    var $validate = array(
            'vehicle_id' => array(
                            'numeric' => array(
                                            'rule' => array('numeric'),
                            //'message' => 'Your custom message here',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                            ),
            ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

     var $involucrados = array('acreedor', 'deudor');
     
     var $elements = array(
          array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array(
                                'acreedor'=>'Acreedor',
                                'deudor'=>'Deudor',
                                ))),
          array('field_forms/character_data'=> array('field_prefix'=>'acreedor', 'label'=>'Actor Como "Acreedor"')),
          array('field_forms/character_data'=> array('field_prefix'=>'deudor', 'label'=>'Actor Como "Deudor"')),
    );

     var $form_id = 3;


      var $fieldsBlackList = array('modified', 'created','deudor_porcentaje', 'acreedor_porcentaje');





    public function beforeSave($options)
    {
        if (!empty($this->data[$this->name]['i_concepto'])) {
            switch ($this->data[$this->name]['i_concepto']) {
                case 'saldo':
                    $this->data[$this->name]['i_concepto_saldo'] = 'X';
                    break;
                case 'prestamo':
                    $this->data[$this->name]['i_concepto_prestamo'] = 'X';
                    break;
                case 'garantiapago':
                    $this->data[$this->name]['i_concepto_sgtia_pago'] = 'GARANTIA DE PAGO';
                    break;
                default:
                    break;
            }
        }

        if (!empty($this->data[$this->name]['i_clausula'])) {
            switch ($this->data[$this->name]['i_clausula']) {
                case 'si':
                    $this->data[$this->name]['i_clausula_si'] = 'X';
                    break;
                case 'no':
                    $this->data[$this->name]['i_clausula_no'] = 'X';
                    break;
                default:
                    break;
            }  
        } 

        return parent::beforeSave($options);

     }


     


    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
         $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            $this->__preformTipo1('acreedor', 'Identificación del Acreedor'),
            $this->__preformTipo1('deudor', 'Identificación del Deudor'),
            $this->__vehiclePreform1('"G" Identificación del Automotor'),

            array(
                'legend'=>'"A"',
                'a_dia'	=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Día', 'value'=> date('d',strtotime('now'))),
                'a_mes'	=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes', 'value'=> date('m',strtotime('now'))),
                'a_anio'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año', 'value'=> date('y',strtotime('now'))),
                'a_monto' =>array('label'=>'Monto del contrato'),
               
            ) ,

            array(
                'legend'=>'"I" Modalidades del Contrato',
                'i_grado' => array('label'=>'Grado N°'),
                'i_clausula' => array('options'=>array('si'=>'SI', 'no'=>'NO'), 'label'=>'Cláusula de actualización', 'empty'=>'Seleccione'),
                'i_clausula_si'=> array('type'=>'hidden'),
                'i_clausula_no'=> array('type'=>'hidden')	,
                'i_concepto' => array('options'=>array('saldo'=>'Saldo de Precio', 'prestamo'=>'Préstamo','garantiapago'=>'Garantia de Pago'), 'label'=>'Concepto'),
                'i_concepto_saldo'=> array('type'=>'hidden'),
                'i_concepto_prestamo'=> array('type'=>'hidden'),
                
            ),
            
            array(
                'legend'=>'"J" Conste que el contrato fue presentado',
                'j_dia' =>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Día'),
                'j_mes' =>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes'),
                'j_anio' =>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año'),
                'j_seccional' => array('Seccional'),
            ),

            array(
                'legend'=>'"K" Certifico',
                'k_lugar' => array('Lugar'),
                'k_mes' =>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes')	,
                'k_anio' =>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año'),
            ),
            array(
                'legend'=>'"L"',
                'l_autorizo'=> array('label'=>'Autorizo'),
                'l_dni' => array('label'=>'DNI'),
            ),
            array(
                'legend'=>'"M" Endoso',
                'm_endozo' => array('label'=>'Endozo'),
                'm_mes'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes'),
                'm_anio'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año'),
                'm_registro_endoso'=> array('label'=>'Registro del endozo'),
                'm_paguese'=> array('label'=>'paguese'),
                'm_registrado'=> array('label'=>'registrado'),
                'm_domiciliado_en'=> array('label'=>'domiciliado en'),
                'm_a_favor_de'=> array('label'=>'a favor de'),
                'm_calle'=> array('label'=>'calle'),
                'm_numero_calle'=> array('label'=>'calle n°'),
                'm_libro_registro'=> array('label'=>'libro registro'),
                'm_registro_endoso_de'=> array('label'=>'registro endoso de'),
            ),
            array(
                'legend'=>'"N" Cancelación del Contrato',
                'n_de'	=>array('label'=>'día'),
                'n_del_anio'	=>array('label'=>'Año'),
                'n_registro_cancelacion_dia' => array('label'=>'Cancelación día')	,
                'n_registro_cancelacion_mes'  => array('label'=>'Cancelación mes')	,
                'n_registro_cancelacion_anio'  => array('label'=>'Cancelación año'),
            ),
            array(
                'legend'=>'"O" Traslado',
                'o_traslado' =>array('label'=>'traslado'),
                'o_traslado_dia' =>array('label'=>'trslado día'),
                'o_traslado_mes' =>array('label'=>'traslado mes'),
                'o_traslado_anio' =>array('label'=>'traslado año'),
                'o_se_tomo_nota' =>array('label'=>'se tomó nota'),
                'o_n' =>array('label'=>'n°'),
            ),
             
            );


        return $coso;
    }

}
?>