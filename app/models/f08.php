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
        $this->populateFieldWithValue("dominio", $d["Vehicle"]["patente"]);
        $this->populateFieldWithValue("asasas",$d['F08']['a_precio_compra']);


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

        $this->populateFieldWithValue("t  entero %", $tEntero);
        $this->populateFieldWithValue("t decimal %", $tDecimal);

        // $this->populateFieldWithValue("a inscripcion", $d["Model"]["fieldname"]);

        $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                'renglones'=> array("a apellido 1", "a apellido 2", "a apellido 3 (cuit)")
                ),$d);


        if (!empty($d['Vehicle']['Customer']['CustomerHome'])) {
            foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {
                if ($h['type']== 'Legal') {
                    $this->populateFieldWithValue("a calle", $h["address"]);
                    $this->populateFieldWithValue("a numero", $h["number"]);
                    $this->populateFieldWithValue("a piso", $h["floor"]);
                    $this->populateFieldWithValue("a depto", $h["apartment"]);
                    $this->populateFieldWithValue("a cod pos", $h["postal_code"]);
                    $this->populateFieldWithValue("a localidad", $h["city"]);
                    $this->populateFieldWithValue("a partido", $h["county"]);
                    $this->populateFieldWithValue("a provincia", $h["state"]);
                }
            }
        }

        // PERSONA FÍSICA
        if (!empty($d['Vehicle']['Customer']['CustomerNatural'])) {

            $multipleChoiceIdentification = array(
                    'argentino'=> array(
                            'dni' => 'a arg dni',
                            'le' => "a arg le",
                            'lc' => "a arg lc",
                    ),
                    'extranjero' => array(
                            'dni' => "a ext dni",
                            'ci' => "a ext ci",
                            'pasaporte' => "a ext pas",
                    )
            );
            $this->populateIdentifications(
                    $d['Vehicle']['Customer']['CustomerNatural']['nationality_type'],
                    $d['Vehicle']['Customer']['Identification']['identification_type_id'],
                    $multipleChoiceIdentification);

            $this->populateFieldWithValue("a n doc", $d['Vehicle']['Customer']['Identification']['number']);
            $this->populateFieldWithValue("a autoridad", $d['Vehicle']['Customer']['Identification']['authority_name']);
            $aBornDate = array(
                    'dia'=> 'a dia',
                    'mes'=> 'a mes',
                    'año'=> 'a año',
            );
            $this->populateDayMonthYear($d['Vehicle']['Customer']['born'], $aBornDate);


            $aFieldsMaritalStat = array(
                    'casado'=> "a casado",
                    'soltero'=> "a sol",
                    'viudo'=> "a viudo",
                    'divorciado'=> "a divor",
            );
            $this->populateMaritalStatuses($d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id'], $aFieldsMaritalStat);
            $this->populateFieldWithValue("a nupcia", $d['Vehicle']["Customer"]['CustomerNatural']['nuptials']);
            if (!empty($d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name'])) {
                $this->populateFieldWithValue("a nombre", $d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name']);
            }
        } else {
            // PErSONA JURIDICA
            $this->populateFieldWithValue("a personeria", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_entity"]);
            $this->populateFieldWithValue("a datos", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_number"]);
            $clBornDate = array(
                    'dia' => 'a diaa',
                    'mes' => 'a mess',
                    'año' => 'a añoo',
            );
            $this->populateDayMonthYear($d['Vehicle']['Customer']['born'], $clBornDate);
        }




        //      E   ::Condominio
        if (!empty($d["Character"])) {

            // PORCENTAJE
            $tEntero = (int)$d['Character']['porcentaje'];
            $tDecimal = (int)(($d['Character']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("c entero %", $tEntero);
            $this->populateFieldWithValue("c decimal %", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglones(array(
                    'renglones'=> array("c nombre 1", "c nombre 2", "c nombre 3"),
                    'field_name'=> $d["Character"]["name"],
            ));

            $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                    'renglones'=> array("d apellido 1", "d apellido 2", "d apellido 3 (cuil)")
                    ),$d,'Character');
            $this->populateFieldWithValue("d calle", $d["Character"]["calle"]);
            $this->populateFieldWithValue("d numero", $d["Character"]["numero_calle"]);
            $this->populateFieldWithValue("d piso", $d["Character"]["piso"]);
            $this->populateFieldWithValue("d depto", $d["Character"]["depto"]);
            $this->populateFieldWithValue("d cod pos", $d["Character"]["cp"]);
            $this->populateFieldWithValue("d localidad", $d["Character"]["localidad"]);
            $this->populateFieldWithValue("d partido", $d["Character"]["departamento"]);
            $this->populateFieldWithValue("d provincia", $d["Character"]["provincia"]);


            $dId = array(
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
                    $d['Character']['nationality_type_id'],
                    $d['Character']['identification_type_id'],
                    $dId);

            $this->populateFieldWithValue("d n doc", $d["Character"]["identification_number"]);
            $this->populateFieldWithValue("d autoridad", $d["Character"]["identification_authority"]);

            $dBornDate = array(
                    'dia'=> "d dia",
                    'mes'=> "d mes",
                    'año'=> "d año",
            );
            $this->populateDayMonthYear($d['Character']['fecha_nacimiento'], $dBornDate);


            $dFieldsMaritalStat = array(
                    'casado'=> "d casado",
                    'soltero'=> "d sol",
                    'viudo'=> "d viudo",
                    'divorciado'=> "d divor",
            );
            $this->populateMaritalStatuses($d['Character']['marital_status_id'], $dFieldsMaritalStat);

            $this->populateFieldWithValue("d nupcia", $d["Character"]["nupcia"]);
            $this->populateFieldWithValue("d nombre", $d["Character"]["conyuge"]);
            $this->populateFieldWithValue("d personeria", $d["Character"]["personeria_otorgada"]);
            $this->populateFieldWithValue("d datos", $d["Character"]["inscripcion"]);
            $dInscDate = array(
                    'dia'=> "d diaa",
                    'mes'=> "d mess",
                    'año'=> "d añoo",
            );
            $this->populateDayMonthYear($d['Character']['fecha_inscripcion'], $dInscDate);
        }


        //      F
        $this->populateFieldWithValue("g dominio", $d["Vehicle"]["patente"]);
        $this->populateFieldWithValue("g marca", $d["Vehicle"]["brand"]);
        $this->populateFieldWithValue("g tipo", $d["Vehicle"]["type"]);
        $this->populateFieldWithValue("g modelo", $d["Vehicle"]["model"]);
        $this->populateFieldWithValue("g marca motor", $d["Vehicle"]["motor_brand"]);
        $this->populateFieldWithValue("g n motor", $d["Vehicle"]["motor_number"]);
        $this->populateFieldWithValue("g marca chasis", $d["Vehicle"]["chasis_brand"]);
        $this->populateFieldWithValue("g n chasis", $d["Vehicle"]["chasis_number"]);
        $this->populateFieldWithValue("g uso", $d["Vehicle"]["use"]);



        //      H
        $this->populateFieldWithValue("c entero %", $d['F08']['h1_fecha']);
        $this->populateFieldWithValue("c entero %", $d['F08']['h1_importe']);
        $this->populateFieldWithValue("c entero %", $d['F08']['h1_acreedor']);
        $this->populateFieldWithValue("c entero %", $d['F08']['h2_fecha']);
        $this->populateFieldWithValue("c entero %", $d['F08']['h2_importe']);
        $this->populateFieldWithValue("c entero %", $d['F08']['h2_acreedor']);


    }


    

    function mapDataPage2() {
        $d = $this->data;

        //      I   Vendedor
        if (!empty($d["Vendedor"])) {

            // PORCENTAJE
            $tEntero = (int)$d['Vendedor']['porcentaje'];
            $tDecimal = (int)(($d['Vendedor']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("c entero %", $tEntero);
            $this->populateFieldWithValue("c decimal %", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglones(array(
                    'renglones'=> array("c nombre 1", "c nombre 2", "c nombre 3"),
                    'field_name'=> $d["Vendedor"]["name"],
            ));

            $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                    'renglones'=> array("d apellido 1", "d apellido 2", "d apellido 3 (cuil)")
                    ),$d,'Vendedor');
            $this->populateFieldWithValue("d calle", $d["Vendedor"]["calle"]);
            $this->populateFieldWithValue("d numero", $d["Vendedor"]["numero_calle"]);
            $this->populateFieldWithValue("d piso", $d["Vendedor"]["piso"]);
            $this->populateFieldWithValue("d depto", $d["Vendedor"]["depto"]);
            $this->populateFieldWithValue("d cod pos", $d["Vendedor"]["cp"]);
            $this->populateFieldWithValue("d localidad", $d["Vendedor"]["localidad"]);
            $this->populateFieldWithValue("d partido", $d["Vendedor"]["departamento"]);
            $this->populateFieldWithValue("d provincia", $d["Vendedor"]["provincia"]);


            $dId = array(
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
                    $d['Vendedor']['nationality_type_id'],
                    $d['Vendedor']['identification_type_id'],
                    $dId);

            $this->populateFieldWithValue("d n doc", $d["Vendedor"]["identification_number"]);
            $this->populateFieldWithValue("d autoridad", $d["Vendedor"]["identification_authority"]);

            $dBornDate = array(
                    'dia'=> "d dia",
                    'mes'=> "d mes",
                    'año'=> "d año",
            );
            $this->populateDayMonthYear($d['Vendedor']['fecha_nacimiento'], $dBornDate);


            $dFieldsMaritalStat = array(
                    'casado'=> "d casado",
                    'soltero'=> "d sol",
                    'viudo'=> "d viudo",
                    'divorciado'=> "d divor",
            );
            $this->populateMaritalStatuses($d['Vendedor']['marital_status_id'], $dFieldsMaritalStat);

            $this->populateFieldWithValue("d nupcia", $d["Vendedor"]["nupcia"]);
            $this->populateFieldWithValue("d nombre", $d["Vendedor"]["conyuge"]);
            $this->populateFieldWithValue("d personeria", $d["Vendedor"]["personeria_otorgada"]);
            $this->populateFieldWithValue("d datos", $d["Vendedor"]["inscripcion"]);
            $dInscDate = array(
                    'dia'=> "d diaa",
                    'mes'=> "d mess",
                    'año'=> "d añoo",
            );
            $this->populateDayMonthYear($d['Vendedor']['fecha_inscripcion'], $dInscDate);
        }
        
        
        //      J   Condominio del Vendedor
        if (!empty($d["VendedorCondominio"])) {
            // PORCENTAJE
            $tEntero = (int)$d['VendedorCondominio']['porcentaje'];
            $tDecimal = (int)(($d['VendedorCondominio']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("c entero %", $tEntero);
            $this->populateFieldWithValue("c decimal %", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglones(array(
                    'renglones'=> array("c nombre 1", "c nombre 2", "c nombre 3"),
                    'field_name'=> $d["VendedorCondominio"]["name"],
            ));

            $this->meterNombreCompletoEnVariosRenglonesConCuit(array(
                    'renglones'=> array("d apellido 1", "d apellido 2", "d apellido 3 (cuil)")
                    ),$d,'VendedorCondominio');
            $this->populateFieldWithValue("d calle", $d["VendedorCondominio"]["calle"]);
            $this->populateFieldWithValue("d numero", $d["VendedorCondominio"]["numero_calle"]);
            $this->populateFieldWithValue("d piso", $d["VendedorCondominio"]["piso"]);
            $this->populateFieldWithValue("d depto", $d["VendedorCondominio"]["depto"]);
            $this->populateFieldWithValue("d cod pos", $d["VendedorCondominio"]["cp"]);
            $this->populateFieldWithValue("d localidad", $d["VendedorCondominio"]["localidad"]);
            $this->populateFieldWithValue("d partido", $d["VendedorCondominio"]["departamento"]);
            $this->populateFieldWithValue("d provincia", $d["VendedorCondominio"]["provincia"]);


            $dId = array(
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
                    $d['VendedorCondominio']['nationality_type_id'],
                    $d['VendedorCondominio']['identification_type_id'],
                    $dId);

            $this->populateFieldWithValue("d n doc", $d["VendedorCondominio"]["identification_number"]);
            $this->populateFieldWithValue("d autoridad", $d["VendedorCondominio"]["identification_authority"]);

            $dBornDate = array(
                    'dia'=> "d dia",
                    'mes'=> "d mes",
                    'año'=> "d año",
            );
            $this->populateDayMonthYear($d['VendedorCondominio']['fecha_nacimiento'], $dBornDate);


            $dFieldsMaritalStat = array(
                    'casado'=> "d casado",
                    'soltero'=> "d sol",
                    'viudo'=> "d viudo",
                    'divorciado'=> "d divor",
            );
            $this->populateMaritalStatuses($d['VendedorCondominio']['marital_status_id'], $dFieldsMaritalStat);

            $this->populateFieldWithValue("d nupcia", $d["VendedorCondominio"]["nupcia"]);
            $this->populateFieldWithValue("d nombre", $d["VendedorCondominio"]["conyuge"]);
            $this->populateFieldWithValue("d personeria", $d["VendedorCondominio"]["personeria_otorgada"]);
            $this->populateFieldWithValue("d datos", $d["VendedorCondominio"]["inscripcion"]);
            $dInscDate = array(
                    'dia'=> "d diaa",
                    'mes'=> "d mess",
                    'año'=> "d añoo",
            );
            $this->populateDayMonthYear($d['VendedorCondominio']['fecha_inscripcion'], $dInscDate);
        }


        

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


        //      M :: Observaciones
        $this->populateFieldWithValue("observaciones", $d["F08"]["observaciones"]);


        //      O :: Autorizo
        $this->populateFieldWithValue("observaciones", $d["F08"]["o_autorizado_name"]);
        $this->populateFieldWithValue("observaciones", $d["F08"]["o_tipo_y_num_doc"]);
        
    }
}
?>