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

    var $belongsTo = array('Vehicle', 'Representative', 'Spouse', 'Character');


    public function find($conditions = 'data', $fields = array(), $order = null, $recursive = null) {
        $ret = parent::find($conditions, $fields, $order, $recursive);


        if (!empty($ret['F08'])) {
            $this->Character->recursive = -1;
            $this->Character->id = $ret['F08']['vendedor_id'];
            $vendedor = $this->Character->read();

            $this->Character->id = $ret['F08']['vendedor_condominium_id'];
            $vendedorCond = $this->Character->read();

            $ret['Vendedor'] = $vendedor['Character'];
            $ret['VendedorCondominio'] = $vendedorCond['Character'];
        }
//debug($ret);
        return $ret;
    }


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 6;
    }


    function setSContain() {
        $this->sContain = array(
                'Character',
                'Representative',
                'Spouse',
                'Vehicle' => array(
                        'Customer'=>array(
                                'Character'=>array('CharacterType'),
                                'Representative',
                                'CustomerLegal',
                                'CustomerNatural'=>array('Spouse'),
                                'CustomerHome',
                                'Identification'=>array('IdentificationType')
                        )
                )
        );
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
                'renglones'=> array("d nombre", "d denomincacion")
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
                    'renglones'=> array("d apellido 1", "d apellido 2", "d apellido 3 (cuil)")
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
            $this->populateFieldWithValue("e apellidoe", $d["Character"]["conyuge"]);
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
                        'extanjero' => array(
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
            }
        } else {
            if (!empty($d[$tipo])) {
                $name = $d[$tipo]["apoderado_name"];
                $id_type_id = 'apoderado_identification_type_id';
                $id_number = $d[$tipo]["apoderado_identification_number"];
                $auth =  $d[$tipo]["apoderado_identification_auth"];
            }
        }

        $this->populateIdentifications($d['Representative']['nationality_type'], $d[$tipo][$id_type_id], $fieldApoderado);
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