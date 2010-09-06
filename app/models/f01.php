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
            array(
                'legend'=>'Identificación del Titular',
                'comprador_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'comprador_cuit_cuil'=>array('label'=>'CUIT o CUIL EXTRA'),
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
                'legend'=>'Identificación del Condominio',
                'condominiocomprador_porcentaje'=>array('label'=>array('text'=>'Porcentaje (%) ','style'=>'float:left; margin-top: 6px;')),
                'condominiocomprador_cuit_cuil'=>array('label'=>'CUIT o CUIL EXTRA'),
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
                'legend'=>'Identificación del Automotor',
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
                'vehicle_adquisition_value' => array('label'=>'Valor de adquisición','value'=>$data['Vehicle']['adquisition_value']),
                'vehicle_adquisition_dia'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Día', 'value'=> date('d',strtotime($data['Vehicle']['adquisition_date']))),
                'vehicle_adquisition_mes'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes', 'value'=> date('m',strtotime($data['Vehicle']['adquisition_date']))),
                'vehicle_adquisition_anio'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año', 'value'=> date('y',strtotime($data['Vehicle']['adquisition_date']))),
                'vehicle_adquisition_evidence_element' => array('label'=>'Elemento provatorio de la adquisición','value'=>$data['Vehicle']['adquisition_evidence_element']),
                
            ),

            array(
                'legend'=>'+',
                'se_certifica_obs' => array('type'=>'textarea', 'label'=>'Se certifica que las condiciones de indetificación que figuran en esta solicitud fueron verificacas con el certificado de fabricación y con el automotor cuya inscripción se solicita a favor del señor'),
                 'obervaciones' => array('label'=>'Observaciones', 'type'=>'textarea'),
                 ),
            
             array(
                'legend'=>'Apoderado del Titular',
                'comprador_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
                'comprador_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'empty'=>'Seleccione','options'=>$identificationsTypes),
                'comprador_apoderado_identification_number'=>array('label'=>'N° Documento',),
                'comprador_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'comprador_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'representative_fecha_firma',
            ),
            array(
                 'legend'=>'Apoderado del Condominio',
                'condominiocomprador_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
                'condominiocomprador_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación', 'empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiocomprador_apoderado_identification_number'=>array('label'=>'N° Documento', ),
                'condominiocomprador_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiocomprador_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
            ),
        );
            


        return $coso;
    }

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

        return true;
        
     }


    function mapDataPage1() {
        $d = $this->data;

        $this->populateFieldWithValue("dominio", $d["Vehicle"]["patente"]);


        /**********************************************************************
         *
         *                      TITULAR
         */

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

        $this->populateFieldWithValue("t  entero %", $tEntero);
        $this->populateFieldWithValue("t decimal %", $tDecimal);


        // NOMBRE   (Si es persona jurídica le tengo que poner el CUIT a lo ultimo del nombre)
        $tName = $d['Vehicle']['Customer']['name'];
        if (!empty($d['Vehicle']['Customer']['Identification']['IdentificationType'])) {
            $tipoYDoc = $d['Vehicle']['Customer']['Identification']['IdentificationType']['name']." ".$d['Vehicle']['Customer']['Identification']['number'];

            $tipoYDoc = ($d['Vehicle']['Customer']['Identification']['IdentificationType']['id'] == 2) // SI ES CUIT !
                    ? $tipoYDoc : '';
            $tName .= " ".$tipoYDoc;
            // die($tName);
        }
        $this->meterNombreCompletoEnVariosRenglones(array(
                'renglones'=> array("t nombre 1", "t nombre 2", "t nombre 3"),
                'field_name'=> $tName,
        ));


        // DOMICILIO
        if (!empty($d['Vehicle']['Customer']['CustomerHome'])) {
            foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {
                if ($h['type']== 'Legal') {
                    $this->populateFieldWithValue("t calle", $h["address"]);
                    $this->populateFieldWithValue("t numero", $h["number"]);
                    $this->populateFieldWithValue("t localidad", $h["city"]);
                    $this->populateFieldWithValue("t piso", $h["floor"]);
                    $this->populateFieldWithValue("t depto", $h["apartment"]);
                    $this->populateFieldWithValue("t cod postal", $h["postal_code"]);
                    $this->populateFieldWithValue("t partido o depto", $h["county"]);
                    $this->populateFieldWithValue("t provincia", $h["state"]);
                    break;
                }
            }
        }

        // PERSONA FÍSICA
        if (!empty($d['Vehicle']['Customer']['Customernatural'])) {

            $multipleChoiceIdentification = array(
                    'argentino'=> array(
                            'dni' => 't dni',
                            'le' => "t l.e",
                            'lc' => "t l.c",
                    ),
                    'extranjero' => array(
                            'dni' => "t extranjeros d.n.i",
                            'ci' => "t extranjerps c.i",
                            'pasaporte' => "t extranjeros pasaporte",
                    )
            );
            $this->populateIdentifications(
                    $d['Vehicle']['Customer']['Customernatural']['nationality_type'],
                    $d['Vehicle']['Customer']['Identification']['identification_type_id'],
                    $multipleChoiceIdentification);
            $this->populateFieldWithValue("t n° documento", $d['Vehicle']['Customer']['Identification']['number']);
            $this->populateFieldWithValue("t autoridad q lo expidio", $d['Vehicle']['Customer']['Identification']['authority_name']);
            $this->populateFieldWithValue("t dia", date('d',strtotime($d['Vehicle']['Customer']['born'])));
            $this->populateFieldWithValue("t mes", date('m',strtotime($d['Vehicle']['Customer']['born'])));
            $this->populateFieldWithValue("t año", date('y',strtotime($d['Vehicle']['Customer']['born'])));


            $fieldsMaritalStat = array(
                    'casado'=> "t casado",
                    'soltero'=> "t soltero",
                    'viudo'=> "t viudo",
                    'divorciado'=> "t divorciado",
            );
            $this->populateMaritalStatuses($d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id'], $fieldsMaritalStat);
            $this->populateFieldWithValue("t nupcia", $d['Vehicle']["Customer"]['CustomerNatural']['nuptials']);
            if (!empty($d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name'])) {
                $this->populateFieldWithValue("t nombre conyuge", $d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name']);
            }
        }

        // PERSONA JURÍDICA
        if (!empty($d['Vehicle']["Customer"]['CustomerLegal'])) {
            $this->populateFieldWithValue("t personeria", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_entity"]);
            $this->populateFieldWithValue("t datos de inscr", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_number"]);
            $this->populateFieldWithValue("t diaa", date('d',strtotime($d['Vehicle']['Customer']['born'])));
            $this->populateFieldWithValue("t mess", date('m',strtotime($d['Vehicle']['Customer']['born'])));
            $this->populateFieldWithValue("t añoo", date('y',strtotime($d['Vehicle']['Customer']['born'])));

        }



        /**********************************************************************
         *
         *                      VEHICULO
         */
        $this->populateFieldWithValue("n° cert automotor", $d["Vehicle"]["fabrication_certificate"]);
        $this->populateFieldWithValue("marca", $d["Vehicle"]["brand"]);
        $this->populateFieldWithValue("tipo", $d["Vehicle"]["type"]);
        $this->populateFieldWithValue("modelo", $d["Vehicle"]["model"]);
        $this->populateFieldWithValue("marca motor", $d["Vehicle"]["motor_brand"]);
        $this->populateFieldWithValue("n° motor", $d["Vehicle"]["motor_number"]);
        $this->populateFieldWithValue("marca chasis", $d["Vehicle"]["chasis_brand"]);
        $this->populateFieldWithValue("carroceria", $d["Vehicle"]["chasis_number"]);
        $this->populateFieldWithValue("uso", $d["Vehicle"]["use"]);

        $this->populateFieldWithValue("valor adq", $d['Vehicle']['adquisition_value']);

        $fieldsCondFechaInscripcion = array(
                'dia'=> "adq dia",
                'mes'=> "adq mes",
                'año'=> "adq año",
        );
        $this->populateDayMonthYear($d['Vehicle']['adquisition_date'], $fieldsCondFechaInscripcion );
        $this->populateFieldWithValue("elemento prob de adq", $d['Vehicle']['adquisition_evidence_element']);










        /**********************************************************************
         *
         *                      CONDOMINIO
         */
        if (!empty($d['Character'])) {
            // PORCENTAJE
            $tEntero = (int)$d['Character']['porcentaje'];
            $tDecimal = (int)(($d['Character']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("c entero %", $tEntero);
            $this->populateFieldWithValue("c decimal %", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                    'renglones'=> array("c nombre 1", "c nombre 2", "c nombre 3")),
                    'Character');


            // DOMICILIO
            $this->populateFieldWithValue("c calle", $d["Character"]["calle"]);
            $this->populateFieldWithValue("c numero", $d["Character"]["numero_calle"]);
            $this->populateFieldWithValue("c piso", $d["Character"]["piso"]);
            $this->populateFieldWithValue("c depto", $d["Character"]["depto"]);
            $this->populateFieldWithValue("c cod postal", $d["Character"]["cp"]);
            $this->populateFieldWithValue("c localidad", $d["Character"]["localidad"]);
            $this->populateFieldWithValue("c partido o depto", $d["Character"]["departamento"]);
            $this->populateFieldWithValue("c provincia", $d["Character"]["provincia"]);


            // PERSONA FÍSICA
            if ('Física' == $d["Character"]["persona_fisica_o_juridica"]) {
                $condom_id_campos = array(
                        'argentino'=> array(
                                'dni' => "c dni",
                                'le' => "c l.e",
                                'lc' => "c l.c",
                        ),
                        'extranjero' => array(
                                'dni' => "c extranjeros dni",
                                'ci'=> "c extranjeros c.i",
                                'pasaporte' => "c extranjeros pasaporte",
                        )
                );
                $this->populateIdentifications($d["Character"]["nationality_type_id"], $d["Character"]["identification_type_id"], $condom_id_campos);

                $this->populateFieldWithValue("c documento", $d["Character"]["identification_number"]);
                $this->populateFieldWithValue("c autoridad q lo expidio", $d["Character"]["identification_authority"]);


                $fieldsCondFechaNacimiento = array(
                        'dia'=> "c dia",
                        'mes'=> "c mes",
                        'año'=> "c año",
                );
                $this->populateDayMonthYear($d['Character']['fecha_nacimiento'], $fieldsCondFechaNacimiento);


                $condFieldsMaritalStat = array(
                        'casado'=> "c soltero",
                        'soltero'=> "c soltero",
                        'viudo'=> "c viudo",
                        'divorciado'=> "c divorciado",
                );
                $this->populateMaritalStatuses($d["Character"]["marital_status_id"], $condFieldsMaritalStat);

                $this->populateFieldWithValue("c nupcia", $d["Character"]["nupcia"]);
                $this->populateFieldWithValue("c nombre conyuge", $d["Character"]["conyuge"]);
                $this->populateFieldWithValue("c personeria", $d["Character"]["personeria_otorgada"]);
                $this->populateFieldWithValue("c datos de inscrip", $d["Character"]["inscripcion"]);
            }
            else {
                // PERSONA JURÍDICA
                $fieldsCondFechaInscripcion = array(
                        'dia'=> "c diaa",
                        'mes'=> "c mess",
                        'año'=> "c añoo",
                );
                $this->populateDayMonthYear($d['Character']['fecha_inscripcion'], $fieldsCondFechaInscripcion );
            }

            //$this->populateFieldWithValue("fecha, sello ...", $d["Character"]["fieldname"]);

        }// Fin COndominio
    }



    function mapDataPage2() {
        $d = $this->data;
        // APODERADO DEL TITULAR: REPRESENTATIVE
        if (!empty($d['Representative'])) {
            $fieldApoderado = array(
                    'none'=>array(
                            'dni'=> "tt dni",
                            'le'=> "tt l.e",
                            'ci'=> "tt c.i",
                            'lc'=> "tt l.c",
                            'pasaporte'=> "tt pasaporte",
            ));
            $this->populateIdentifications('none', $d['Representative']['identification_type_id'], $fieldApoderado);

            $this->populateFieldWithValue("tt apellido", $d['Representative']["surname"]. " " .$d['Representative']["name"]);
            $this->populateFieldWithValue("tt numero", $d["Representative"]["identification_number"]);
            $this->populateFieldWithValue("tt autoridad", $d["Representative"]["nationality"]);
        }


        /**********************************************************************
         *
         *                      CONDOMINIO
         */
        if (!empty($d['Character'])) {
            // APODERADO DEL CONDOMINIO
            $this->populateFieldWithValue("cc apellido", $d["Character"]["apoderado_name"]);
            $fieldCondominioApoderado = array(
                    'none'=>array(
                            'dni'=> "cc dni",
                            'le'=> "cc l.e",
                            'ci'=> "cc c.i",
                            'lc'=> "cc l.c",
                            'pasaporte'=> "cc pasaporte",
            ));
            $this->populateIdentifications('none', $d['Character']['apoderado_identification_type_id'], $fieldCondominioApoderado);
            $this->populateFieldWithValue("cc numero", $d["Character"]["apoderado_identification_number"]);
            $this->populateFieldWithValue("cc autoridad", $d["Character"]["apoderado_identification_auth"]);
        }


        /**********************************************************************
         *
         *                      OBSERVACIONES
         */
        $this->populateFieldWithValue("se certifica...", $d["F01"]["se_certifica_obs"]);
        $this->populateFieldWithValue("observaciones", $d["F01"]["observaciones"]);


    }
}

?>
