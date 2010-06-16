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

    var $belongsTo = array('Vehicle',
        'Character'=>array('foreignKey'=>'deudor_id'), // deudor
        );


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 3;
    }


    function setSContain() {
        $this->sContain = array(
                'Character',
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
        $this->populateDayMonthYear($d['F03']['a_fecha_contrato']);
        $this->populateFieldWithValue("monto del contrato", $d["F03"]["a_monto_contrato"]);


        //   D  ::Acreedor
        $a = $d['Vehicle']['Customer'];


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




        //      E   ::Deudor
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


        //      G
        $this->populateFieldWithValue("g dominio", $d["Vehicle"]["patente"]);
        $this->populateFieldWithValue("g marca", $d["Vehicle"]["brand"]);
        $this->populateFieldWithValue("g tipo", $d["Vehicle"]["type"]);
        $this->populateFieldWithValue("g modelo", $d["Vehicle"]["model"]);
        $this->populateFieldWithValue("g marca motor", $d["Vehicle"]["motor_brand"]);
        $this->populateFieldWithValue("g n motor", $d["Vehicle"]["motor_number"]);
        $this->populateFieldWithValue("g marca chasis", $d["Vehicle"]["chasis_brand"]);
        $this->populateFieldWithValue("g n chasis", $d["Vehicle"]["chasis_number"]);



        //      H
        if ($d["F03"]["h_si"]) {
            $this->populateFieldWithValue("h solicitud si", 'X');
        } else {
            $this->populateFieldWithValue("h solicitud no", 'X');
        }

        //      I   Modalidades del contrato
        if ($d['F03']['i_clausula_actualizacion']) {
            $this->populateFieldWithValue("i clausula si", 'X');
        } else {
            $this->populateFieldWithValue("i clausula no", 'X');
        }
        $this->populateFieldWithValue("i grado", $d["F03"]["i_grado"]);

        if ($d['F03']['i_concepto_prestamo']) {
            $this->populateFieldWithValue("i concepto prestamo", 'X');
        } else {
            $this->populateFieldWithValue("i concepto saldo", 'X');
        }



    }


    function mapDataPage2() {
        $d = $this->data;
        
        //      J
        $this->populateFieldWithValue("j seccional", $d["F03"]["j_registro_seccional_de"]);
        $this->populateFieldWithValue("j dia", $d["F03"]["j_dia"]);
        $this->populateFieldWithValue("j mes", $d["F03"]["j_mes"]);
        $this->populateFieldWithValue("j año", $d["F03"]["j_anio"]);

        //      K
        $this->populateFieldWithValue("k lugar", $d["F03"]["k_lugar_y_dia"]);
        $this->populateFieldWithValue("k mes", $d["F03"]["k_mes"]);
        $this->populateFieldWithValue("k año", $d["F03"]["k_anio"]);


        //      L
        $this->populateFieldWithValue("l autorizo", $d["F03"]["l_autorizo"]);
        $this->populateFieldWithValue("l dni", $d["F03"]["l_doc"]);


        //      M
        $this->populateFieldWithValue("m endoso", $d["F03"]["m_dia"]);
        $this->populateFieldWithValue("m mes", $d["F03"]["m_mes"]);
        $this->populateFieldWithValue("m año", $d["F03"]["m_anio"]);
        $this->populateFieldWithValue("m paguese", $d["F03"]["m_a_la_orden"]);
        $this->populateFieldWithValue("m domiciliado en", $d["F03"]["m_domicilio"]);
        $this->populateFieldWithValue("m calle", $d["F03"]["m_calle"]);
        $this->populateFieldWithValue("m n°", $d["F03"]["m_numero"]);

        $this->populateFieldWithValue("registro endoso", $d["F03"]["m_algo"]);
        $this->populateFieldWithValue("m registro endoso de", $d["F03"]["m_de"]);
        $this->populateFieldWithValue("registrado", $d["F03"]["m_endoso_de"]);
        $this->populateFieldWithValue("a favor de", $d["F03"]["m_favor_de"]);
        $this->populateFieldWithValue("libro registro", $d["F03"]["m_folio"]);



        //      N
        $this->populateFieldWithValue("n de..", $d["F03"]["n_contrato_mes"]);
        $this->populateFieldWithValue("n del año...", $d["F03"]["n_contrato_anio"]);
        $this->populateFieldWithValue("registro cancelacion dia", $d["F03"]["n_cancela_dia"]);
        $this->populateFieldWithValue("registro cancelacion mes", $d["F03"]["n_cancela_mes"]);
        $this->populateFieldWithValue("registro cancelacion año", $d["F03"]["n_cancela_anio"]);

        //      O
        $this->populateFieldWithValue("o traslado", $d["F03"]["o_traslado"]);
        $this->populateFieldWithValue("o mes", $d["F03"]["o_de"]);
        $this->populateFieldWithValue("o año", $d["F03"]["o_anio"]);
        $this->populateFieldWithValue("o se tomo nota...", $d["F03"]["o_ubicacion"]);
        $this->populateFieldWithValue("o n°", $d["F03"]["o_numero"]);
    }

}
?>