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


    var $belongsTo = array('Vehicle','Condominium','Spouse', 'Representative');


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 1;
    }


    function setSContain() {
        $this->sContain = array(
                'Condominium',
                'Representative',
                'Spouse',
                'Vehicle' => array(
                        'Customer'=>array(
                                'Condominium',
                                'Representative',
                                'CustomerLegal',
                                'CustomerNatural'=>array('Spouse'),
                                'CustomerHome',
                                'Identification'=>array('IdentificationType')
                        )
                )
        );
    }

    function getViewVars () {
        $coso = $this->find();

        $ret = array();
        if (!empty($coso['Vehicle']['Customer']['CustomerNatural']['Spouse'])) {
            $sps = $coso['Vehicle']['Customer']['CustomerNatural']['Spouse'];
            $vec = array();
            foreach ($sps as $s) {
                $vec[$s['id']] = $s['name'];
            }
            $ret = $vec;
        }

        $retCondominios = array();
        if (!empty($coso['Vehicle']['Customer']['Condominium'])) {
            $con = $coso['Vehicle']['Customer']['Condominium'];
            $vec2 = array();
            foreach ($con as $c) {
                $vec2[$c['id']] = $c['name'];
            }
            $retCondominios = $vec2;
        }

        $retRepresentatives = array();
        if (!empty($coso['Vehicle']['Customer']['Representative'])) {
            $con = $coso['Vehicle']['Customer']['Representative'];
            $vec3 = array();
            foreach ($con as $c) {
                $vec3[$c['id']] = $c['name'];
            }
            $retRepresentatives = $vec3;
        }

        return array('spouses'=>$ret, 'condominia'=>$retCondominios, 'representatives'=>$retRepresentatives);
    }

    

    function mapDataPage1() {
        $d = $this->data;

        $this->populateFieldWithValue("dominio", $d["Vehicle"]["patente"]);


        /**********************************************************************
         *
         *                      TITULAR
         */

        // PORCENTAJE TITULAR
        if (empty($d['Condominium'])) {
            $tEntero = '100';
            $tDecimal = '00';
        } else {
            $valor = abs(100-$d['Condominium']['porcentaje']);
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
            debug($tipoYDoc);
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
            $this->populateFieldWithValue("t dia", date('d',strtotime($d['Vehicle']['Customer']['Identification'])));
            $this->populateFieldWithValue("t mes", date('m',strtotime($d['Vehicle']['Customer']['Identification'])));
            $this->populateFieldWithValue("t año", date('y',strtotime($d['Vehicle']['Customer']['Identification'])));


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
        if (!empty($d['Condominium'])) {
            // PORCENTAJE
            $tEntero = (int)$d['Condominium']['porcentaje'];
            $tDecimal = (int)(($d['Condominium']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("c entero %", $tEntero);
            $this->populateFieldWithValue("c decimal %", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglones(array(
                    'renglones'=> array("c nombre 1", "c nombre 2", "c nombre 3"),
                    'field_name'=> $d["Condominium"]["name"],
            ));

            // DOMICILIO
            $this->populateFieldWithValue("c calle", $d["Condominium"]["calle"]);
            $this->populateFieldWithValue("c numero", $d["Condominium"]["numero_calle"]);
            $this->populateFieldWithValue("c piso", $d["Condominium"]["piso"]);
            $this->populateFieldWithValue("c depto", $d["Condominium"]["depto"]);
            $this->populateFieldWithValue("c cod postal", $d["Condominium"]["cp"]);
            $this->populateFieldWithValue("c localidad", $d["Condominium"]["localidad"]);
            $this->populateFieldWithValue("c partido o depto", $d["Condominium"]["departamento"]);
            $this->populateFieldWithValue("c provincia", $d["Condominium"]["provincia"]);


            // PERSONA FÍSICA
            if ('Física' == $d["Condominium"]["persona_fisica_o_juridica"]) {
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
                $this->populateIdentifications($d["Condominium"]["nationality_type_id"], $d["Condominium"]["identification_type_id"], $condom_id_campos);

                $this->populateFieldWithValue("c documento", $d["Condominium"]["identification_number"]);
                $this->populateFieldWithValue("c autoridad q lo expidio", $d["Condominium"]["identification_authority"]);


                $fieldsCondFechaNacimiento = array(
                        'dia'=> "c dia",
                        'mes'=> "c mes",
                        'año'=> "c año",
                );
                $this->populateDayMonthYear($d['Condominium']['fecha_nacimiento'], $fieldsCondFechaNacimiento);


                $condFieldsMaritalStat = array(
                        'casado'=> "c soltero",
                        'soltero'=> "c soltero",
                        'viudo'=> "c viudo",
                        'divorciado'=> "c divorciado",
                );
                $this->populateMaritalStatuses($d["Condominium"]["marital_status_id"], $condFieldsMaritalStat);

                $this->populateFieldWithValue("c nupcia", $d["Condominium"]["nupcia"]);
                $this->populateFieldWithValue("c nombre conyuge", $d["Condominium"]["conyuge"]);
                $this->populateFieldWithValue("c personeria", $d["Condominium"]["personeria_otorgada"]);
                $this->populateFieldWithValue("c datos de inscrip", $d["Condominium"]["inscripcion"]);
            }
            else {
                // PERSONA JURÍDICA
                $fieldsCondFechaInscripcion = array(
                        'dia'=> "c diaa",
                        'mes'=> "c mess",
                        'año'=> "c añoo",
                );
                $this->populateDayMonthYear($d['Condominium']['fecha_inscripcion'], $fieldsCondFechaInscripcion );
            }

            //$this->populateFieldWithValue("fecha, sello ...", $d["Condominium"]["fieldname"]);

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
        if (!empty($d['Condominium'])) {
            // APODERADO DEL CONDOMINIO
            $this->populateFieldWithValue("cc apellido", $d["Condominium"]["apoderado_name"]);
            $fieldCondominioApoderado = array(
                    'none'=>array(
                            'dni'=> "cc dni",
                            'le'=> "cc l.e",
                            'ci'=> "cc c.i",
                            'lc'=> "cc l.c",
                            'pasaporte'=> "cc pasaporte",
            ));
            $this->populateIdentifications('none', $d['Condominium']['apoderado_identification_type_id'], $fieldCondominioApoderado);
            $this->populateFieldWithValue("cc numero", $d["Condominium"]["apoderado_identification_number"]);
            $this->populateFieldWithValue("cc autoridad", $d["Condominium"]["apoderado_identification_auth"]);
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
