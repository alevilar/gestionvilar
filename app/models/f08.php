<?php

App::import('Lib', 'FormSkeleton');

class F08 extends FormSkeleton {
    var $name = 'F08';
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

    var $form_id = 6;


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


    public function beforeSave($options) {
        // modificar fechas de formato dd-mm-aa hay que poner cada dato por separado
//         'fecha_dia'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Día', 'value'=> date('d',strtotime('now'))),
//         'fecha_mes'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes', 'value'=> date('m',strtotime('now'))),
//         'fecha_anio'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año', 'value'=> date('y',strtotime('now'))),
//
        if (!empty( $this->data[$this->name]['comprador_fecha_nacimiento'])) {
            list(   $this->data[$this->name]['comprador_dia_nacimiento'],
                    $this->data[$this->name]['comprador_mes_nacimiento'],
                    $this->data[$this->name]['comprador_anio_nacimiento'])
                 = split('[/.-]', $this->data[$this->name]['comprador_fecha_nacimiento']);
            }
        if (!empty( $this->data[$this->name]['comprador_fecha_inscripcion'])) {
            list(   $this->data[$this->name]['comprador_dia_inscripcion'],
                    $this->data[$this->name]['comprador_mes_inscripcion'],
                    $this->data[$this->name]['comprador_anio_inscripcion'])
                 = split('[/.-]', $this->data[$this->name]['comprador_fecha_inscripcion']);
        }

        if (!empty( $this->data[$this->name]['condominiocomprador_fecha_nacimiento'])) {
            list(   $this->data[$this->name]['condominiocomprador_dia_nacimiento'],
                    $this->data[$this->name]['condominiocomprador_mes_nacimiento'],
                    $this->data[$this->name]['condominiocomprador_anio_nacimiento'])
                 = split('[/.-]', $this->data[$this->name]['condominiocomprador_fecha_nacimiento']);
            }
        if (!empty( $this->data[$this->name]['condominiocomprador_fecha_inscripcion'])) {
            list(   $this->data[$this->name]['condominiocomprador_dia_inscripcion'],
                    $this->data[$this->name]['condominiocomprador_mes_inscripcion'],
                    $this->data[$this->name]['condominiocomprador_anio_inscripcion'])
                 = split('[/.-]', $this->data[$this->name]['condominiocomprador_fecha_inscripcion']);
        }

        if (!empty( $this->data[$this->name]['vendedor_fecha_nacimiento'])) {
            list(   $this->data[$this->name]['vendedor_dia_nacimiento'],
                    $this->data[$this->name]['vendedor_mes_nacimiento'],
                    $this->data[$this->name]['vendedor_anio_nacimiento'])
                 = split('[/.-]', $this->data[$this->name]['vendedor_fecha_nacimiento']);
            }
        if (!empty( $this->data[$this->name]['vendedor_fecha_inscripcion'])) {
            list(   $this->data[$this->name]['vendedor_dia_inscripcion'],
                    $this->data[$this->name]['vendedor_mes_inscripcion'],
                    $this->data[$this->name]['vendedor_anio_inscripcion'])
                 = split('[/.-]', $this->data[$this->name]['vendedor_fecha_inscripcion']);
        }

        if (!empty( $this->data[$this->name]['condomioniovendedor_fecha_nacimiento'])) {
            list(   $this->data[$this->name]['condomioniovendedor_dia_nacimiento'],
                    $this->data[$this->name]['condomioniovendedor_mes_nacimiento'],
                    $this->data[$this->name]['condomioniovendedor_anio_nacimiento'])
                 = split('[/.-]', $this->data[$this->name]['condomioniovendedor_fecha_nacimiento']);
            }
        if (!empty( $this->data[$this->name]['condomioniovendedor_fecha_inscripcion'])) {
            list(   $this->data[$this->name]['condomioniovendedor_dia_inscripcion'],
                    $this->data[$this->name]['condomioniovendedor_mes_inscripcion'],
                    $this->data[$this->name]['condomioniovendedor_anio_inscripcion'])
                 = split('[/.-]', $this->data[$this->name]['condomioniovendedor_fecha_inscripcion']);
        }


        // COMPRADOR
        if (!empty( $this->data[$this->name]['comprador_identification_type_id'])) {
            switch ($this->data[$this->name]['comprador_identification_type_id']) {
                case 1: //DNI
                    if ($this->data[$this->name]['comprador_nationality_type_id'] == 'argentino') {
                        $this->data[$this->name]['comprador_identification_dni'] = 'X';
                    } else {
                        $this->data[$this->name]['comprador_identification_dni_ext'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['comprador_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['comprador_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['comprador_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['comprador_identification_ci'] = 'X';
                    breaK;
            }
        }       
        switch ($this->data[$this->name]['comprador_marital_status_id']) {
            case 1: // Casado
                $this->data[$this->name]['comprador_casado'] = 'X';
                break;
            case 2: //Soltero
                $this->data[$this->name]['comprador_soltero'] = 'X';
                break;
            case 3: // Viudo
                $this->data[$this->name]['comprador_viudo'] = 'X';
                break;
            case 4 : // DIvorciado
                $this->data[$this->name]['comprador_divorciado'] = 'X';
                break;
        }


        // CONDOMINIO COMPRADOR
        if (!empty( $this->data[$this->name]['condominiocomprador_identification_type_id'])) {
            switch ($this->data[$this->name]['condominiocomprador_identification_type_id']) {
                case 1: //DNI
                    if ($this->data[$this->name]['condominiocomprador_nationality_type_id'] == 'argentino') {
                        $this->data[$this->name]['condominiocomprador_identification_dni'] = 'X';
                    } else {
                        $this->data[$this->name]['condominiocomprador_identification_dni_ext'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['condominiocomprador_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['condominiocomprador_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['condominiocomprador_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['condominiocomprador_identification_ci'] = 'X';
                    breaK;
            }
        }
        if (!empty( $this->data[$this->name]['condominiocomprador_marital_status_id'])) {
            switch ($this->data[$this->name]['condominiocomprador_marital_status_id']) {
                case 1: // Casado
                    $this->data[$this->name]['condominiocomprador_casado'] = 'X';
                    break;
                case 2: //Soltero
                    $this->data[$this->name]['condominiocomprador_soltero'] = 'X';
                    break;
                case 3: // Viudo
                    $this->data[$this->name]['condominiocomprador_viudo'] = 'X';
                    break;
                case 4 : // DIvorciado
                    $this->data[$this->name]['condominiocomprador_divorciado'] = 'X';
                    break;
            }
        }


        // VENDEDOR
        if (!empty( $this->data[$this->name]['vendedor_identification_type_id'])) {
            switch ($this->data[$this->name]['vendedor_identification_type_id']) {
                case 1: //DNI
                    if ($this->data[$this->name]['vendedor_nationality_type_id'] == 'argentino') {
                        $this->data[$this->name]['vendedor_identification_dni'] = 'X';
                    } else {
                        $this->data[$this->name]['vendedor_identification_dni_ext'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['vendedor_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['vendedor_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['vendedor_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['vendedor_identification_ci'] = 'X';
                    breaK;
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


        // CONDOMINIO VENDEDOR
        if (!empty( $this->data[$this->name]['condominiovendedor_identification_type_id'])) {
            switch ($this->data[$this->name]['condominiovendedor_identification_type_id']) {
                case 1: //DNI
                    if ($this->data[$this->name]['condominiovendedor_nationality_type_id'] == 'argentino') {
                        $this->data[$this->name]['condominiovendedor_identification_dni'] = 'X';
                    } else {
                        $this->data[$this->name]['condominiovendedor_identification_dni_ext'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['condominiovendedor_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['condominiovendedor_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['condominiovendedor_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['condominiovendedor_identification_ci'] = 'X';
                    breaK;
            }
        }
        switch ($this->data[$this->name]['condominiovendedor_marital_status_id']) {
            case 1: // Casado
                $this->data[$this->name]['condominiovendedor_casado'] = 'X';
                break;
            case 2: //Soltero
                $this->data[$this->name]['condominiovendedor_soltero'] = 'X';
                break;
            case 3: // Viudo
                $this->data[$this->name]['condominiovendedor_viudo'] = 'X';
                break;
            case 4 : // DIvorciado
                $this->data[$this->name]['condominiovendedor_divorciado'] = 'X';
                break;
        }
        return true;
    }

    function getFormImputs($data) {
         $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
         $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            array(
                'legend'=>'"D" Comprador o Adquiriente',
                'comprador_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'comprador_name'=>array('label'=>'Apellido y Nombre o Denominación', 'class'=>'nombre_con_cuit'),
                'comprador_calle'=>array('label'=>'Calle'),
                'comprador_numero_calle'=>array('label'=>'Número'),
                'comprador_piso'=>array('label'=>'Piso'),
                'comprador_depto'=>array('label'=>'Dep'),
                'comprador_cp'=>array('label'=>'Código Postal'),
                'comprador_localidad'=>array('label'=>'Localidad'),
                'comprador_departamento'=>array('label'=>'Partido o Departamento'),
                'comprador_provincia'=>array('label'=>'Provincia'),
                'comprador_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'comprador_identification_number'=>array('label'=>'N° Documento'),
                'comprador_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'comprador_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'comprador_fecha_nacimiento'=>array('label'=>'Fecha de Nacimiento','type'=>'text'),
                'comprador_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'comprador_nupcia'=>array('label'=>'Nupcia'),
                'comprador_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),
                
                'comprador_personeria_otorgada'=>array('label'=>'personeria otorgada por'),
                'comprador_inscripcion'=>array('label'=>'N° o datos de inscripción o creación'),
                'comprador_fecha_inscripcion'=>array('label'=>'Fecha de inscripción o creación','type'=>'text'),
                'comprador_persona_fisica_o_juridica'=>array('type'=>'hidden'),

//                'comprador_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge', 'type'=>'hidden'),
//                'comprador_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'type'=>'hidden','empty'=>'Seleccione','options'=>$identificationsTypes),
//                'comprador_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento', 'type'=>'hidden'),
//                'comprador_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'type'=>'hidden', 'options'=>$nationalities),
//                'comprador_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió', 'type'=>'hidden'),
                ),
            array(
                'legend'=>'"E" Condominio en la Compra o Adquisición',
                'condominiocomprador_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'condominiocomprador_name'=>array('label'=>'Apellido y Nombre o Denominación', 'class'=>'nombre_con_cuit'),
                'condominiocomprador_calle'=>array('label'=>'Calle'),
                'condominiocomprador_numero_calle'=>array('label'=>'Número'),
                'condominiocomprador_piso'=>array('label'=>'Piso'),
                'condominiocomprador_depto'=>array('label'=>'Dep'),
                'condominiocomprador_cp'=>array('label'=>'Código Postal'),
                'condominiocomprador_localidad'=>array('label'=>'Localidad'),
                'condominiocomprador_departamento'=>array('label'=>'Partido o Departamento'),
                'condominiocomprador_provincia'=>array('label'=>'Provincia'),
                'condominiocomprador_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiocomprador_identification_number'=>array('label'=>'N° Documento'),
                'condominiocomprador_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiocomprador_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'condominiocomprador_fecha_nacimiento'=>array('label'=>'Fecha de Nacimiento','type'=>'text'),
                'condominiocomprador_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'condominiocomprador_nupcia'=>array('label'=>'Nupcia'),
                 'condominiocomprador_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),

                'condominiocomprador_personeria_otorgada'=>array('label'=>'personeria otorgada por'),
                'condominiocomprador_inscripcion'=>array('label'=>'N° o datos de inscripción o creación'),
                'condominiocomprador_fecha_inscripcion'=>array('label'=>'Fecha de inscripción o creación','type'=>'text'),
                'condominiocomprador_persona_fisica_o_juridica'=>array('type'=>'hidden'),
                
//                'condominiocomprador_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge', 'type'=>'hidden'),
//                'condominiocomprador_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'type'=>'hidden','empty'=>'Seleccione','options'=>$identificationsTypes),
//                'condominiocomprador_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento', 'type'=>'hidden'),
//                'condominiocomprador_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'type'=>'hidden', 'options'=>$nationalities),
//                'condominiocomprador_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió', 'type'=>'hidden'),
            ),
            array(
                'legend'=>'"I" Vendedor o Transmitente',
                'vendedor_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'vendedor_name'=>array('label'=>'Apellido y Nombre o Denominación'),
//                'vendedor_calle'=>array('label'=>'Calle'),
//                'vendedor_numero_calle'=>array('label'=>'Número'),
//                'vendedor_piso'=>array('label'=>'Piso'),
//                'vendedor_depto'=>array('label'=>'Dep'),
//                'vendedor_cp'=>array('label'=>'Código Postal'),
//                'vendedor_localidad'=>array('label'=>'Localidad'),
//                'vendedor_departamento'=>array('label'=>'Partido o Departamento'),
//                'vendedor_provincia'=>array('label'=>'Provincia'),
                'vendedor_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'vendedor_identification_number'=>array('label'=>'N° Documento'),
                'vendedor_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'vendedor_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                //'vendedor_fecha_nacimiento'=>array('label'=>'Fecha de Nacimiento','type'=>'text'),
                'vendedor_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'vendedor_nupcia'=>array('label'=>'Nupcia'),
//                'vendedor_personeria_otorgada'=>array('label'=>'personeria otorgada por'),
//                'vendedor_inscripcion'=>array('label'=>'N° o datos de inscripción o creación'),
//                'vendedor_fecha_inscripcion'=>array('label'=>'Fecha de inscripción o creación','type'=>'text'),
//                'vendedor_persona_fisica_o_juridica'=>array('type'=>'hidden'),

                'vendedor_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),
                'vendedor_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge'),
                'vendedor_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'vendedor_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento'),
                'vendedor_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'vendedor_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),

                'vendedor_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
//                'vendedor_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
//                'vendedor_apoderado_identification_number'=>array('label'=>'N° Documento'),
//                'vendedor_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
//                'vendedor_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'i_fecha_sello'=>array('label'=>'Fecha, Sello y firma del certificante'),
            ),
            array(
                'legend'=>'"J" Condominio en la venta o Transmisión',
                'condominiovendedor_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'condominiovendedor_name'=>array('label'=>'Apellido y Nombre o Denominación'),
//                'condominiovendedor_calle'=>array('label'=>'Calle'),
//                'condominiovendedor_numero_calle'=>array('label'=>'Número'),
//                'condominiovendedor_piso'=>array('label'=>'Piso'),
//                'condominiovendedor_depto'=>array('label'=>'Dep'),
//                'condominiovendedor_cp'=>array('label'=>'Código Postal'),
//                'condominiovendedor_localidad'=>array('label'=>'Localidad'),
//                'condominiovendedor_departamento'=>array('label'=>'Partido o Departamento'),
//                'condominiovendedor_provincia'=>array('label'=>'Provincia'),
                'condominiovendedor_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiovendedor_identification_number'=>array('label'=>'N° Documento'),
                'condominiovendedor_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiovendedor_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
//                'condominiovendedor_fecha_nacimiento'=>array('label'=>'Fecha de Nacimiento','type'=>'text'),
                'condominiovendedor_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'condominiovendedor_nupcia'=>array('label'=>'Nupcia'),
//                'condominiovendedor_personeria_otorgada'=>array('label'=>'personeria otorgada por'),
//                'condominiovendedor_inscripcion'=>array('label'=>'N° o datos de inscripción o creación'),
//                'condominiovendedor_fecha_inscripcion'=>array('label'=>'Fecha de inscripción o creación','type'=>'text'),
//                'condominiovendedor_persona_fisica_o_juridica'=>array('type'=>'hidden'),

                'condominiovendedor_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),
                'condominiovendedor_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge'),
                'condominiovendedor_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiovendedor_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento'),
                'condominiovendedor_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiovendedor_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),

                'condominiovendedor_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
//                'condominiovendedor_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
//                'condominiovendedor_apoderado_identification_number'=>array('label'=>'N° Documento'),
//                'condominiovendedor_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
//                'condominiovendedor_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'j_fecha_sello'=>array('label'=>'Fecha, Sello y firma del certificante'),
            ),
             array(
                'legend'=>'"A"',
                'a_lugar_contrato'=>array('label'=>'Lugar y fecha de celebración del contrato'),
                'a_precio_compra'=>array('label'=>'Precio de compra (en caso de omisión, sucesión, premio, etc. escribir el concepto)'),
                ),

            array(
                'legend'=>'"F" Vehículo que se tansfiere',
                'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                'vehicle_patente'=> array('label'=>'Dominio','value'=>$data['Vehicle']['patente']),
                'vehicle_brand' => array('label'=>'Marca','value'=>$data['Vehicle']['brand']),
                'vehicle_type' => array('label'=>'Tipo','value'=>$data['Vehicle']['type']),
                'vehicle_model' => array('label'=>'Modelo','value'=>$data['Vehicle']['model']),
                'vehicle_motor_brand' => array('label'=>'Marca del Motor','value'=>$data['Vehicle']['motor_brand']),
                'vehicle_motor_number' => array('label'=>'N° de Motor','value'=>$data['Vehicle']['motor_number']),
                'vehicle_chasis_brand' => array('label'=>'Marca del Chasis','value'=>$data['Vehicle']['chasis_brand']),
                'vehicle_chasis_number' => array('label'=>'N° de Chasis','value'=>$data['Vehicle']['chasis_number']),
                'vehicle_use' => array('label'=>'N° de Chasis','value'=>$data['Vehicle']['use']),
            ),
            array(
                'legend'=>'"K" Comprador o Adquiriente',
                'comprador_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
                'comprador_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'empty'=>'Seleccione','options'=>$identificationsTypes),
                'comprador_apoderado_identification_number'=>array('label'=>'N° Documento',),
                'comprador_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'comprador_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'representative_fecha_firma',
            ),
            array(
                'legend'=>'"L" Condominio en la compra o adquisición',
                'condominiocomprador_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
                'condominiocomprador_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiocomprador_apoderado_identification_number'=>array('label'=>'N° Documento', ),
                'condominiocomprador_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiocomprador_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
            ),
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



    function mapDataPage1() {
        $d = $this->data;

        //   A
        $this->populateFieldWithValue("a dominio", $d["Vehicle"]["patente"]);
        $this->populateFieldWithValue("a precio compra",$d['F08']['a_precio_compra']);
        $this->populateFieldWithValue("a lugar y fecha|",$d['F08']['a_lugar_contrato']);


        //   D  :: COmprador
        $a = $d['Vehicle']['Customer'];


        // PORCENTAJE TITULAR
        if (empty($d['Character'])) {
            $tEntero = '100';
            $tDecimal = '00';
        } else {
            $valor = abs(100-$d['Character']['porcentaje']);
            $tEntero = (int)$valor;
            $tDecimal = (int)(($valor-$tEntero)*100);
            if ($tDecimal == 0) {
                $tDecimal = '00';
            }
        }

        $this->populateFieldWithValue("d % 1", $tEntero);
        $this->populateFieldWithValue("d %2", $tDecimal);

        // $this->populateFieldWithValue("a inscripcion", $d["Model"]["fieldname"]);

        $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                'renglones'=> array("d nombre", "d denomincacion".'d denominacionnn')
        ));


        if (!empty($d['Vehicle']['Customer']['CustomerHome'])) {
            foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {
                if ($h['type']== 'Legal') {
                    $this->populateFieldWithValue("d calle", $h["address"]);
                    $this->populateFieldWithValue("d numero", $h["number"]);
                    $this->populateFieldWithValue("d piso", $h["floor"]);
                    $this->populateFieldWithValue("d dep", $h["apartment"]);
                    $this->populateFieldWithValue("d cod postal", $h["postal_code"]);
                    $this->populateFieldWithValue("d loc", $h["city"]);
                    $this->populateFieldWithValue("d partido", $h["county"]);
                    $this->populateFieldWithValue("d provincia", $h["state"]);
                }
            }
        }

        // PERSONA FÍSICA
        if (!empty($d['Vehicle']['Customer']['CustomerNatural'])) {

            $multipleChoiceIdentification = array(
                    'argentino'=> array(
                            'dni' => 'd arg dni',
                            'le' => "d arg le",
                            'lc' => "d arg lc",
                    ),
                    'extranjero' => array(
                            'dni' => "d ext dni",
                            'ci' => "d ext ci",
                            'pasaporte' => "d ext pas",
                    )
            );
            $this->populateIdentifications(
                    $d['Vehicle']['Customer']['CustomerNatural']['nationality_type'],
                    $d['Vehicle']['Customer']['Identification']['identification_type_id'],
                    $multipleChoiceIdentification);

            $this->populateFieldWithValue("d n dni", $d['Vehicle']['Customer']['Identification']['number']);
            $this->populateFieldWithValue("d autoridad", $d['Vehicle']['Customer']['Identification']['authority_name']);
            $aBornDate = array(
                    'dia'=> 'd dia',
                    'mes'=> 'd mes',
                    'año'=> 'd año',
            );
            $this->populateDayMonthYear($d['Vehicle']['Customer']['born'], $aBornDate);


            $aFieldsMaritalStat = array(
                    'casado'=> "d casado",
                    'soltero'=> "d soltero",
                    'viudo'=> "d viudo",
                    'divorciado'=> "d divor",
            );
            $this->populateMaritalStatuses($d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id'], $aFieldsMaritalStat);

            $this->populateFieldWithValue("d nupcia", $d['Vehicle']["Customer"]['CustomerNatural']['nuptials']);
            if (!empty($d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name'])) {
                $this->populateFieldWithValue("d apellido", $d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name']);
            }
        } else {
            // PErSONA JURIDICA
            $this->populateFieldWithValue("d personeria", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_entity"]);
            $this->populateFieldWithValue("d datos", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_number"]);
            $clBornDate = array(
                    'dia' => 'd diaa',
                    'mes' => 'd mess',
                    'año' => 'd añoo',
            );
            $this->populateDayMonthYear($d['Vehicle']['Customer']['born'], $clBornDate);
        }




        //      E   ::Condominio
        if (!empty($d["Character"])) {

            // PORCENTAJE
            $tEntero = (int)$d['Character']['porcentaje'];
            $tDecimal = (int)(($d['Character']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("e %1", $tEntero);
            $this->populateFieldWithValue("e %2", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                    'renglones'=> array("d nombre", "d denomincacion",'e denominacionnn')
                    ),'Character');

            $this->populateFieldWithValue("e calle", $d["Character"]["calle"]);
            $this->populateFieldWithValue("e numero", $d["Character"]["numero_calle"]);
            $this->populateFieldWithValue("e piso", $d["Character"]["piso"]);
            $this->populateFieldWithValue("e dep", $d["Character"]["depto"]);
            $this->populateFieldWithValue("e cp", $d["Character"]["cp"]);
            $this->populateFieldWithValue("e loc", $d["Character"]["localidad"]);
            $this->populateFieldWithValue("e partido", $d["Character"]["departamento"]);
            $this->populateFieldWithValue("e provincia", $d["Character"]["provincia"]);


            $dId = array(
                    'argentino'=> array(
                            'dni' => 'e arg dni',
                            'le' => "e arg le",
                            'lc' => "e arg lc",
                    ),
                    'extranjero' => array(
                            'dni' => "e ext dni",
                            'ci' => "e ext ci",
                            'pasaporte' => "e ext pas",
                    )
            );
            $this->populateIdentifications(
                    $d['Character']['nationality_type_id'],
                    $d['Character']['identification_type_id'],
                    $dId);

            $this->populateFieldWithValue("e n dni", $d["Character"]["identification_number"]);
            $this->populateFieldWithValue("e autoridad", $d["Character"]["identification_authority"]);

            $dBornDate = array(
                    'dia'=> "e dia",
                    'mes'=> "e mes",
                    'año'=> "e año",
            );
            $this->populateDayMonthYear($d['Character']['fecha_nacimiento'], $dBornDate);


            $dFieldsMaritalStat = array(
                    'casado'=> "e casado",
                    'soltero'=> "e soltero",
                    'viudo'=> "e viudo",
                    'divorciado'=> "e divorc",
            );
            $this->populateMaritalStatuses($d['Character']['marital_status_id'], $dFieldsMaritalStat);

            $this->populateFieldWithValue("e nupcia", $d["Character"]["nupcia"]);
            $this->populateFieldWithValue("e apellido", $d["Character"]["conyuge"]);
            $this->populateFieldWithValue("e personeria", $d["Character"]["personeria_otorgada"]);
            $this->populateFieldWithValue("e datos", $d["Character"]["inscripcion"]);
            $dInscDate = array(
                    'dia'=> "e diaa",
                    'mes'=> "e mess",
                    'año'=> "e añoo",
            );
            $this->populateDayMonthYear($d['Character']['fecha_inscripcion'], $dInscDate);
        }


        //      F
        $this->populateFieldWithValue("f dominio", $d["Vehicle"]["patente"]);
        $this->populateFieldWithValue("f marca", $d["Vehicle"]["brand"]);
        $this->populateFieldWithValue("f tipo", $d["Vehicle"]["type"]);
        $this->populateFieldWithValue("f modelo", $d["Vehicle"]["model"]);
        $this->populateFieldWithValue("f marca motor", $d["Vehicle"]["motor_brand"]);
        $this->populateFieldWithValue("f n motor", $d["Vehicle"]["motor_number"]);
        $this->populateFieldWithValue("f marca chasis", $d["Vehicle"]["chasis_brand"]);
        $this->populateFieldWithValue("f n chasis", $d["Vehicle"]["chasis_number"]);
        $this->populateFieldWithValue("f uso", $d["Vehicle"]["use"]);



        //      H
        $this->populateFieldWithValue("h fecha 1", $d['F08']['h1_fecha']);
        $this->populateFieldWithValue("h importe 1", $d['F08']['h1_importe']);
        $this->populateFieldWithValue("h acreedor 1", $d['F08']['h1_acreedor']);
        $this->populateFieldWithValue("h fecha 2", $d['F08']['h2_fecha']);
        $this->populateFieldWithValue("h importe 2", $d['F08']['h2_importe']);
        $this->populateFieldWithValue("h acreedor 2", $d['F08']['h2_acreedor']);


    }




    function meterDatosCondominioVendedor() {
        $d = $this->data;
        if (!empty($d["VendedorCondominio"])) {

            // PORCENTAJE
            $tEntero = (int)$d['VendedorCondominio']['porcentaje'];
            $tDecimal = (int)(($d['VendedorCondominio']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("j porc entero", $tEntero);
            $this->populateFieldWithValue("j porc decimal", $tDecimal);


            $this->populateFieldWithValue("j apellido", $d["VendedorCondominio"]["name"]);

            $vFieldsMaritalStat = array(
                    'casado'=> "j casado",
                    'soltero'=> "jsoltero",
                    'viudo'=> "j viudo",
                    'divorciado'=> "j divor",
            );
            $this->populateMaritalStatuses($d['VendedorCondominio']['marital_status_id'], $vFieldsMaritalStat);

            $this->populateFieldWithValue("j nupcia", $d["VendedorCondominio"]["nupcia"]);

            $this->populateFieldWithValue("j apoderado", $d["VendedorCondominio"]["apoderado_name"]);

            $dId = array(
                    'argentino'=> array(
                            'dni' => 'j arg dni',
                            'le' => "j arg le",
                            'lc' => "j arg lc",
                    ),
                    'extranjero' => array(
                            'dni' => "j ext dni",
                            'ci' => "j ext ci",
                            'pasaporte' => "j ext pasap",
                    )
            );
            $this->populateIdentifications(
                    $d['VendedorCondominio']['nationality_type_id'],
                    $d['VendedorCondominio']['identification_type_id'],
                    $dId);

            $this->populateFieldWithValue("j num dnii", $d["VendedorCondominio"]["identification_number"]);
            $this->populateFieldWithValue("j autoridadd", $d["VendedorCondominio"]["identification_authority"]);

            $this->populateFieldWithValue("j fecha selloo", $d["F08"]["i_fecha_sello"]);

            $this->populateFieldWithValue("j nombre", $d["VendedorCondominio"]["conyuge"]);
            // APODERADO DEL CONYUGE
            if (!empty($d["VendedorCondominio"]["conyuge_apoderado_name"])) {
                $this->populateFieldWithValue("j nombre apoderado", $d["VendedorCondominio"]["conyuge_apoderado_name"]);
                $dId = array(
                        'argentino'=> array(
                                'dni' => 'j arg dnii',
                                'le' => "j arg lee",
                                'lc' => "j arg lcc",
                        ),
                        'extranjero' => array(
                                'dni' => "j ext dnii",
                                'ci' => "j ext cii",
                                'pasaporte' => "j ext pasapp",
                        )
                );
                $this->populateIdentifications(
                        $d['VendedorCondominio']['conyuge_apoderado_nationality_type'],
                        $d['VendedorCondominio']['conyuge_apoderado_identification_type_id'],
                        $dId);

                $this->populateFieldWithValue("j num dnii", $d["VendedorCondominio"]["conyuge_apoderado_identification_number"]);
                $this->populateFieldWithValue("j autoridadd", $d["VendedorCondominio"]["conyuge_apoderado_identification_auth"]);
                $this->populateFieldWithValue("j fecha selloo", $d["F08"]["i_fecha_sello"]);
            }
        }
    }


    function meterDatosVendedor() {
        $d = $this->data;
        if (!empty($d["Vendedor"])) {

            // PORCENTAJE
            $tEntero = (int)$d['Vendedor']['porcentaje'];
            $tDecimal = (int)(($d['Vendedor']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("i porc entero", $tEntero);
            $this->populateFieldWithValue("i porc decimal", $tDecimal);


            $this->populateFieldWithValue("i apellido", $d["Vendedor"]["name"]);

            $vFieldsMaritalStat = array(
                    'casado'=> "i casado",
                    'soltero'=> "i soltero",
                    'viudo'=> "i viudo",
                    'divorciado'=> "i divor",
            );
            $this->populateMaritalStatuses($d['Vendedor']['marital_status_id'], $vFieldsMaritalStat);

            $this->populateFieldWithValue("i nupcia", $d["Vendedor"]["nupcia"]);

            $this->populateFieldWithValue("i apoderado", $d["Vendedor"]["apoderado_name"]);

            $dId = array(
                    'argentino'=> array(
                            'dni' => 'i arg dni',
                            'le' => "i arg le",
                            'lc' => "i arg lc",
                    ),
                    'extranjero' => array(
                            'dni' => "i ext dni",
                            'ci' => "i ext ci",
                            'pasaporte' => "i ext pasap",
                    )
            );
            $this->populateIdentifications(
                    $d['Vendedor']['nationality_type_id'],
                    $d['Vendedor']['identification_type_id'],
                    $dId);

            $this->populateFieldWithValue("i num dni", $d["Vendedor"]["identification_number"]);
            $this->populateFieldWithValue("i autoridad", $d["Vendedor"]["identification_authority"]);

            $this->populateFieldWithValue("i fecha sello", $d["F08"]["i_fecha_sello"]);


            $this->populateFieldWithValue("i nombre", $d["Vendedor"]["conyuge"]);
            // APODERADO DEL CONYUGE
            if (!empty($d["Vendedor"]["conyuge_apoderado_name"])) {
                $this->populateFieldWithValue("i nombre apoderado", $d["Vendedor"]["conyuge_apoderado_name"]);
                $dId = array(
                        'argentino'=> array(
                                'dni' => 'i arg dnii',
                                'le' => "i arg lee",
                                'lc' => "i lc",
                        ),
                        'extranjero' => array(
                                'dni' => "i ext dnii",
                                'ci' => "i ext cii",
                                'pasaporte' => "i ext pasapp",
                        )
                );
                $this->populateIdentifications(
                        $d['Vendedor']['conyuge_apoderado_nationality_type'],
                        $d['Vendedor']['conyuge_apoderado_identification_type_id'],
                        $dId);

                $this->populateFieldWithValue("i num dnii", $d["Vendedor"]["conyuge_apoderado_identification_number"]);
                $this->populateFieldWithValue("i autoridadd", $d["Vendedor"]["conyuge_apoderado_identification_auth"]);
                $this->populateFieldWithValue("i fecha selloo", $d["F08"]["i_fecha_sello"]);
            }
        }
    }

    /**
     *
     * @param string $tipo modelo del representante, Ej: Customer, Character, Vendedor, etc
     * @param array $vMeter vecor normalizado de los campos a meter:
     *       'name' ,
             'arg dni',
             'arg le',
             'arg lc',
             'ext dni',
             'ext ci',
             'ext pasap',
             'numerodoc',
             'autoridad',
     */
    function meterRepresentante($tipo, $vMeter) {
        $d = $this->data;
        $name = '';
        $id_type_id = '';
        $id_number = 0;
        $auth =  '';

        $fieldApoderado = array(
                        'argentino'=>array(
                                'dni'=> $vMeter['arg dni'],
                                'le'=> $vMeter['arg le'],
                                'lc'=> $vMeter['arg lc'],
                        ),
                        'extranjero' => array(
                                'dni'=> $vMeter['ext dni'],
                                'ci'=> $vMeter['ext ci'],
                                'pasap'=> $vMeter['ext pasap'],
                        )
                );
        
        if ($tipo == 'Representative') { // APODERADO DEL TITULAR: REPRESENTATIVE
            if (!empty($d['Representative'])) {
                $name = $d['Representative']["surname"]. " " .$d['Representative']["name"];
                $id_type_id = 'identification_type_id';
                $id_number = $d["Representative"]["identification_number"];
                $auth =  $d["Representative"]["nationality"];
                $nacionalityType = $d['Representative']['nationality_type'];
            }
        } else {
            if (!empty($d[$tipo])) {
                $name = $d[$tipo]["apoderado_name"];
                $id_type_id = 'apoderado_identification_type_id';
                $id_number = $d[$tipo]["apoderado_identification_number"];
                $auth =  $d[$tipo]["apoderado_identification_auth"];
                $nacionalityType = $d[$tipo]['nationality_type_id'];
            }
        }
        $this->populateIdentifications($nacionalityType, $d[$tipo][$id_type_id], $fieldApoderado);
        $this->populateFieldWithValue($vMeter['name'],$name);
        $this->populateFieldWithValue($vMeter['numerodoc'], $id_number);
        $this->populateFieldWithValue($vMeter['autoridad'], $auth);
    }


    function mapDataPage2() {
        $d = $this->data;

        //      I   Vendedor
        $this->meterDatosVendedor();


        //      J   Condominio del Vendedor
        $this->meterDatosCondominioVendedor();


        //      K   Comprador o Adquiriente
        $meter = array(
                'name' => 'k nombre' ,
                'arg dni' => 'k arg dni',
                'arg le' => 'k arg le',
                'arg lc' => 'k arg lc',
                'ext dni' => 'k ext dni',
                'ext ci' => 'k ext ci',
                'ext pasap' => 'k ext pasap',
                'numerodoc' => 'k num dni',
                'autoridad' => 'k autoridad',
        );
        $this->meterRepresentante('Representative', $meter);
        //$this->populateFieldWithValue("k fecha sello", $d["Model"]["fieldname"]);

        //      L   Comprador o Adquiriente
        $meter = array(
                'name'  => 'l nombre',
                'arg dni' => 'l arg dni',
                'arg le' => 'l arg le',
                'arg lc' => 'l arg lc',
                'ext dni' => 'l ext dni',
                'ext ci' => 'l ext ci',
                'ext pasap' => 'l ext pasap',
                'numerodoc' => 'l num dni',
                'autoridad' => '',
        );
        $this->meterRepresentante('Character', $meter);
        //$this->populateFieldWithValue("l fecha sello", $d["Model"]["fieldname"]);


        //      M :: Observaciones
        $this->populateFieldWithValue("m observaciones", $d["F08"]["observaciones"]);


        //      O :: Autorizo
        $this->populateFieldWithValue("o autorizo", $d["F08"]["o_autorizado_name"]);
        $this->populateFieldWithValue("o dni", $d["F08"]["o_tipo_y_num_doc"]);
        $this->populateFieldWithValue("o recibi...", $d["F08"]["o_recibi_tit"]);

    }
}

?>