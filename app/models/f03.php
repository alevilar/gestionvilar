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


    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
         $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            array(
                'legend'=>'Identificación del Acreedor',
                'acreedor_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'acreedor_name'=>array('label'=>'Apellido y Nombre o Denominación', 'class'=>'nombre_con_cuit'),
                'acreedor_calle'=>array('label'=>'Calle'),
                'acreedor_numero_calle'=>array('label'=>'Número'),
                'acreedor_piso'=>array('label'=>'Piso'),
                'acreedor_depto'=>array('label'=>'Dep'),
                'acreedor_cp'=>array('label'=>'Código Postal'),
                'acreedor_localidad'=>array('label'=>'Localidad'),
                'acreedor_departamento'=>array('label'=>'Partido o Departamento'),
                'acreedor_provincia'=>array('label'=>'Provincia'),
                'acreedor_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'acreedor_identification_number'=>array('label'=>'N° Documento'),
                'acreedor_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'acreedor_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'acreedor_fecha_nacimiento'=>array('label'=>'Fecha de Nacimiento','type'=>'text'),
                'acreedor_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'acreedor_nupcia'=>array('label'=>'Nupcia'),
                'acreedor_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),

                'acreedor_personeria_otorgada'=>array('label'=>'personeria otorgada por'),
                'acreedor_inscripcion'=>array('label'=>'N° o datos de inscripción o creación'),
                'acreedor_fecha_inscripcion'=>array('label'=>'Fecha de inscripción o creación','type'=>'text'),
                'acreedor_persona_fisica_o_juridica'=>array('type'=>'hidden'),

//                'acreedor_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge', 'type'=>'hidden'),
//                'acreedor_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'type'=>'hidden','empty'=>'Seleccione','options'=>$identificationsTypes),
//                'acreedor_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento', 'type'=>'hidden'),
//                'acreedor_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'type'=>'hidden', 'options'=>$nationalities),
//                'acreedor_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió', 'type'=>'hidden'),
                ),
            array(
                'legend'=>'Identificación del Condominio',
                'deudor_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'deudor_name'=>array('label'=>'Apellido y Nombre o Denominación', 'class'=>'nombre_con_cuit'),
                'deudor_calle'=>array('label'=>'Calle'),
                'deudor_numero_calle'=>array('label'=>'Número'),
                'deudor_piso'=>array('label'=>'Piso'),
                'deudor_depto'=>array('label'=>'Dep'),
                'deudor_cp'=>array('label'=>'Código Postal'),
                'deudor_localidad'=>array('label'=>'Localidad'),
                'deudor_departamento'=>array('label'=>'Partido o Departamento'),
                'deudor_provincia'=>array('label'=>'Provincia'),
                'deudor_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'deudor_identification_number'=>array('label'=>'N° Documento'),
                'deudor_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'deudor_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'deudor_fecha_nacimiento'=>array('label'=>'Fecha de Nacimiento','type'=>'text'),
                'deudor_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'deudor_nupcia'=>array('label'=>'Nupcia'),
                 'deudor_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),

                'deudor_personeria_otorgada'=>array('label'=>'personeria otorgada por'),
                'deudor_inscripcion'=>array('label'=>'N° o datos de inscripción o creación'),
                'deudor_fecha_inscripcion'=>array('label'=>'Fecha de inscripción o creación','type'=>'text'),
                'deudor_persona_fisica_o_juridica'=>array('type'=>'hidden'),

//                'deudor_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge', 'type'=>'hidden'),
//                'deudor_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'type'=>'hidden','empty'=>'Seleccione','options'=>$identificationsTypes),
//                'deudor_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento', 'type'=>'hidden'),
//                'deudor_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'type'=>'hidden', 'options'=>$nationalities),
//                'deudor_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió', 'type'=>'hidden'),
            ),
            array(
                'legend'=>'"G" Identificación del Automotor',
                'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                'vehicle_patente'=> array('label'=>'Dominio','value'=>$data['Vehicle']['patente']),
                'vehicle_brand' => array('label'=>'Marca','value'=>$data['Vehicle']['brand']),
                'vehicle_type' => array('label'=>'Tipo','value'=>$data['Vehicle']['type']),
                'vehicle_model' => array('label'=>'Modelo','value'=>$data['Vehicle']['model']),
                'vehicle_motor_brand' => array('label'=>'Marca del Motor','value'=>$data['Vehicle']['motor_brand']),
                'vehicle_motor_number' => array('label'=>'N° de Motor','value'=>$data['Vehicle']['motor_number']),
                'vehicle_chasis_brand' => array('label'=>'Marca del Chasis','value'=>$data['Vehicle']['chasis_brand']),
                'vehicle_chasis_number' => array('label'=>'N° de Chasis','value'=>$data['Vehicle']['chasis_number']),                
            ),

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
                'i_clausula' => array('options'=>array(0=>'SI', 1=>'NO'), 'label'=>'Cláusula de actualización'),
                'i_clausula_si'=> array('type'=>'hidden'),
                'i_clausula_no'=> array('type'=>'hidden')	,
                'i_concepto' => array('options'=>array(0=>'Saldo de Precio', 1=>'Préstamo'), 'label'=>'Concepto'),
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




    public function beforeSave($options) {

        if (empty($this->data[$this->name]['i_concepto'])) {
            $this->data[$this->name]['i_concepto_saldo'] = 'X';
        } else {
            $this->data[$this->name]['i_concepto_prestamo'] = 'X';
        }

        if (empty($this->data[$this->name]['i_clausula'])) {
            $this->data[$this->name]['i_clausula_si'] = 'X';
        } else {
            $this->data[$this->name]['i_clausula_no'] = 'X';
        }
        
        if (!empty( $this->data[$this->name]['acreedor_fecha_nacimiento'])) {
            list(   $this->data[$this->name]['acreedor_dia_nacimiento'],
                    $this->data[$this->name]['acreedor_mes_nacimiento'],
                    $this->data[$this->name]['acreedor_anio_nacimiento'])
                 = split('[/.-]', $this->data[$this->name]['acreedor_fecha_nacimiento']);
            }
        if (!empty( $this->data[$this->name]['acreedor_fecha_inscripcion'])) {
            list(   $this->data[$this->name]['acreedor_dia_inscripcion'],
                    $this->data[$this->name]['acreedor_mes_inscripcion'],
                    $this->data[$this->name]['acreedor_anio_inscripcion'])
                 = split('[/.-]', $this->data[$this->name]['acreedor_fecha_inscripcion']);
        }

        if (!empty( $this->data[$this->name]['deudor_fecha_nacimiento'])) {
            list(   $this->data[$this->name]['deudor_dia_nacimiento'],
                    $this->data[$this->name]['deudor_mes_nacimiento'],
                    $this->data[$this->name]['deudor_anio_nacimiento'])
                 = split('[/.-]', $this->data[$this->name]['deudor_fecha_nacimiento']);
            }
        if (!empty( $this->data[$this->name]['deudor_fecha_inscripcion'])) {
            list(   $this->data[$this->name]['deudor_dia_inscripcion'],
                    $this->data[$this->name]['deudor_mes_inscripcion'],
                    $this->data[$this->name]['deudor_anio_inscripcion'])
                 = split('[/.-]', $this->data[$this->name]['deudor_fecha_inscripcion']);
        }

        // COMPRADOR
        if (!empty( $this->data[$this->name]['acreedor_identification_type_id'])) {
            switch ($this->data[$this->name]['acreedor_identification_type_id']) {
                case 1: //DNI
                    if ($this->data[$this->name]['acreedor_nationality_type_id'] == 'argentino') {
                        $this->data[$this->name]['acreedor_identification_dni'] = 'X';
                    } else {
                        $this->data[$this->name]['acreedor_identification_dni_ext'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['acreedor_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['acreedor_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['acreedor_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['acreedor_identification_ci'] = 'X';
                    breaK;
            }
        }
        switch ($this->data[$this->name]['acreedor_marital_status_id']) {
            case 1: // Casado
                $this->data[$this->name]['acreedor_casado'] = 'X';
                break;
            case 2: //Soltero
                $this->data[$this->name]['acreedor_soltero'] = 'X';
                break;
            case 3: // Viudo
                $this->data[$this->name]['acreedor_viudo'] = 'X';
                break;
            case 4 : // DIvorciado
                $this->data[$this->name]['acreedor_divorciado'] = 'X';
                break;
        }


        // CONDOMINIO COMPRADOR
        if (!empty( $this->data[$this->name]['deudor_identification_type_id'])) {
            switch ($this->data[$this->name]['deudor_identification_type_id']) {
                case 1: //DNI
                    if ($this->data[$this->name]['deudor_nationality_type_id'] == 'argentino') {
                        $this->data[$this->name]['deudor_identification_dni'] = 'X';
                    } else {
                        $this->data[$this->name]['deudor_identification_dni_ext'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['deudor_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['deudor_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['deudor_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['deudor_identification_ci'] = 'X';
                    breaK;
            }
        }

        if (!empty( $this->data[$this->name]['deudor_marital_status_id'])) {
            switch ($this->data[$this->name]['deudor_marital_status_id']) {
                case 1: // Casado
                    $this->data[$this->name]['deudor_casado'] = 'X';
                    break;
                case 2: //Soltero
                    $this->data[$this->name]['deudor_soltero'] = 'X';
                    break;
                case 3: // Viudo
                    $this->data[$this->name]['deudor_viudo'] = 'X';
                    break;
                case 4 : // DIvorciado
                    $this->data[$this->name]['deudor_divorciado'] = 'X';
                    break;
            }
        }

        return true;

     }

     

}
?>