<?php

App::import('Lib', 'FormSkeleton');


class F01 extends FormSkeleton {
    var $useTable = false;

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

    /**
     *
     * @param array $options
     *                  array  'renglones' => Son los field_coordenates name, en ellos se imprimiran el valor pasado
     *                  string 'field_name'=> Texto a imprimir en esos renglones
     */
    private function  meterNombreCompletoEnVariosRenglones($options) {
        if(empty($options['renglones'])||empty($options['field_name'])) {
            error_reporting("en metodo meterNomvreCOmpletoEnVariosCamposn no se pasaron los paramentros correctamente");
            debug("no se pasaron los parametros correctamente");
            return -1;
        }

        // preparo el texto en array para recorrerlo y calcular su tamaño
        $vec = explode(" ",$options['field_name']);

        App::import('Vendor','fpdf/fpdf');
        $orientation='P';
        $unit='mm';
        $format='legal';

        $fpdfAux = new FPDF();
        $fpdfAux->FPDF($orientation, $unit, $format);

        $field_coord = ClassRegistry::init('FieldCoordenate');
        foreach($options['renglones'] as $r) {
            $field_coord->find('first', array(
                    'conditions'=>array(
                            'name'=>$r,
                            'field_creator_id'=>$this->getFieldCreatorId(),
            )));

            $texto = '';
            foreach ($vec as &$palabra) {
                if ($field_coord['FieldCoordenate']['w'] >= $fpdfAux->GetStringWidth($texto)) {
                    $texto .= " " . $palabra;
                    unset($palabra);
                } else {
                    $this->populateFieldWithValue($field_coord['FieldCoordenate']['name'], $texto);
                    $texto = ''; // lo vuelvo a inicializar
                    break;
                }
            }

        }
    }


    /**
     *
     * @param string $nationality argentino, extranjero o null es lo que puede venir
     * @param integer $id_type es el id de la tabla identification_types
     * @param array $fieldNames es un array con los nombres de los campos a imprimir
     *                          cargados en la tabla field_coordenates
     *                  las posibilidades son
     *      $fieldNames[argentino|extranjero][dni]
     *                                       [cuit]
     *                                       [le]
     *                                       [lc]
     *                                       [ci]
     *                                       [pasaporte]
     */
    function populateIdentifications($nationality, $id_type, $fieldNames) {
        if ($nationality == 'argentino' || $nationality == 'extranjero') {
            switch($id_type) {
                case 1: // DNI
                    $this->populateFieldWithValue($fieldNames[$nationality]['dni'], 'X');
                    break;
                case 2: // CUIT
                    $this->populateFieldWithValue($fieldNames[$nationality]['cuit'], 'X');
                    break;
                case 3: // LE
                    $this->populateFieldWithValue($fieldNames[$nationality]['le'], 'X');
                    break;
                case 4: // LC
                    $this->populateFieldWithValue($fieldNames[$nationality]['lc'], 'X');
                    break;
                case 5: // CI
                    $this->populateFieldWithValue($fieldNames[$nationality]['ci'], 'X');
                    break;
                case 6: // Pasaporte
                    $this->populateFieldWithValue($fieldNames[$nationality]['pasaporte'], 'X');
                    break;
            }
        }
    }


    function mapData() {
        $d = $this->data;
        $this->populateFieldWithValue("dominio", $d["Vehicle"]["patente"]);

        if (empty($d['Condominium'])) {
            $tEntero = '100';
            $tDecimal = '00';
        } else {
            $valor = $d['Condominium']['porcentaje'];
            $tEntero = (int)$valor;
            $tEntero = (int)(($valor-$tEntero)*100);
        }

        $this->populateFieldWithValue("t entero %", $tEntero);
        $this->populateFieldWithValue("t decimal %", $tDecimal);

        // Si es persona jurídica le tengo que poner el CUIT a lo ultimo del nombre
        $tName = $d['Customer']['name'];
        if (!empty($d['Customer']['Identification']['IdentificationType'])) {
            $tipoYDoc = $d['Customer']['Identification']['IdentificationType']['name']." ".$d['Customer']['number'];

            $tipoYDoc = ($d['Customer']['Identification']['IdentificationType']['id'] == 2) // SI ES CUIT !
                    ? $tipoYDoc : '';
            $tName .= " ".$tipoYDoc;
        }
        $this->meterNombreCompletoEnVariosRenglones(array(
                'renglones'=> array("t nombre 1", "t nombre 2", "t nombre 3"),
                'field_name'=> $tName,
        ));


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

            switch ($d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id']) {
                case 1: // Casado
                    $this->populateFieldWithValue("t casado", 'X');
                    break;
                case 2: //Soltero
                    $this->populateFieldWithValue("t soltero", 'X');
                    break;
                case 3: // Viudo
                    $this->populateFieldWithValue("t viudo", 'X');
                    break;
                case 4 : // DIvorciado
                    $this->populateFieldWithValue("t divorciado", 'X');
                    break;
            }
            $this->populateFieldWithValue("t nupcia", $d['Vehicle']["Customer"]['CustomerNatural']['nuptials']);
            if (!empty($d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name'])) {
                $this->populateFieldWithValue("t nombre conyuge", $d['Vehicle']["Customer"]['CustomerNatural']['Spouse']['name']);
            }
        }


        if (!empty($d['Vehicle']["Customer"]['CustomerLegal'])) {
            $this->populateFieldWithValue("t personeria", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_entity"]);
            $this->populateFieldWithValue("t datos de inscr", $d['Vehicle']["Customer"]['CustomerLegal']["inscription_number"]);
            $this->populateFieldWithValue("t diaa", date('d',strtotime($d['Vehicle']['Customer']['Identification'])));
            $this->populateFieldWithValue("t mess", date('m',strtotime($d['Vehicle']['Customer']['Identification'])));
            $this->populateFieldWithValue("t añoo", date('y',strtotime($d['Vehicle']['Customer']['Identification'])));

        }


        $this->populateFieldWithValue("n° cert automotor", $d["Vehicle"]["fabrication_certificate"]);
        $this->populateFieldWithValue("marca", $d["Vehicle"]["brand"]);
        $this->populateFieldWithValue("tipo", $d["Vehicle"]["type"]);
        $this->populateFieldWithValue("modelo", $d["Vehicle"]["model"]);
        $this->populateFieldWithValue("marca motor", $d["Vehicle"]["motor_brand"]);
        $this->populateFieldWithValue("n° motor", $d["Vehicle"]["motor_number"]);
        $this->populateFieldWithValue("marca chasis", $d["Vehicle"]["chasis_brand"]);
        $this->populateFieldWithValue("carroceria", $d["Vehicle"]["chasis_number"]);
        $this->populateFieldWithValue("uso", $d["Vehicle"]["use"]);


        if (!empty($d['Condominium'])) {
            $tEntero = (int)$d['Condominium']['porcentaje'];
            $tEntero = (int)(($d['Condominium']['porcentaje']-$tEntero)*100);

            $this->populateFieldWithValue("c entero %", $tEntero);
            $this->populateFieldWithValue("c decimal %", $tDecimal);

            $this->meterNombreCompletoEnVariosRenglones(array(
                'renglones'=> array("c nombre 1", "c nombre 2", "c nombre 3"),
                'field_name'=> $d["Condominium"]["name"],
        ));
            $this->populateFieldWithValue("c calle", $d["Condominium"]["calle"]);
            $this->populateFieldWithValue("c numero", $d["Condominium"]["numero_calle"]);
            $this->populateFieldWithValue("c piso", $d["Condominium"]["piso"]);
            $this->populateFieldWithValue("c depto", $d["Condominium"]["depto"]);
            $this->populateFieldWithValue("c cod postal", $d["Condominium"]["cp"]);
            $this->populateFieldWithValue("c localidad", $d["Condominium"]["localidad"]);
            $this->populateFieldWithValue("c partido o depto", $d["Condominium"]["departamento"]);
            $this->populateFieldWithValue("c provincia", $d["Condominium"]["provincia"]);
            
            $this->populateFieldWithValue("c dni", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c l.e", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c l.c", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c extranjeros dni", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c extranjeros c.i", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c extranjeros pasaporte", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c documento", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c autoridad q lo expidio", $d["Condominium"]["fieldname"]);



            
            $this->populateFieldWithValue("c dia", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c mes", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c año", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c soltero", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c casado", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c viudo", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c divorciado", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c nupcia", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c nombre conyuge", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c personeria", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c datos de inscrip", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c diaa", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c mess", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("c añoo", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("valor adq", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("adq dia", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("adq mes", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("adq año", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("elemento prob de adq", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("se certifica...", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("fecha, sello ...", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt apellido", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt dni", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt l.e", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt l.c", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt c.i", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt pasaporte", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc apellido", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc dni", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc l.e", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc l.c", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc c.i", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc pasaporte", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt numero", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("tt autoridad", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc numero", $d["Condominium"]["fieldname"]);
            $this->populateFieldWithValue("cc autoridad", $d["Condominium"]["fieldname"]);
        }

        $this->populateFieldWithValue("observaciones", $d["F01"]["observaciones"]);
    }
}

?>
