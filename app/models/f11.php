<?php

App::import('Lib', 'FormSkeleton');


class F11 extends FormSkeleton {
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


    var $belongsTo = array('Vehicle', 'Representative', 'Spouse');


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 7;
    }


    function setSContain() {
        $this->sContain = array(
                'Spouse',
                'Representative',
                'Vehicle' => array(
                        'Customer'=>array(
                                'Representative',
                                'CustomerNatural'=>array('Spouse'),
                                'CustomerHome',
                                'Identification'=>array('IdentificationType')
                        )
                )
        );
    }




    function mapDataPage2() {
        return null;
    }
    

    function mapDataPage1() {
        $d = $this->data;
        $this->populateFieldWithValue("dominio", $d["Vehicle"]["patente"]);
        $this->populateFieldWithValue("indicar datos...", $d["F11"]["datos"]);
        $this->populateFieldWithValue("vendedor o trans", $d['Vehicle']["Customer"]["name"]);

        if (!empty($d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id'])){
            switch ($d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id']){
               case 1: // Casado
                   $this->populateFieldWithValue("casado", 'X');
               break;
               case 2: //Soltero
                    $this->populateFieldWithValue("soltero", 'X');
                    break;
                case 3: // Viudo
                    $this->populateFieldWithValue("viudo", 'X');
                    break;
                case 4 : // DIvorciado
                    $this->populateFieldWithValue("divorciado", 'X');
                    break;
            }
        }

        if (!empty($d['Representative'])) {
            $apeNom = $d['Representative']['surname']. ' ' .$d['Representative']['name'];
             $this->populateFieldWithValue("apellido y nombre", $apeNom);
            switch ($d['Representative']['identification_type_id']){
                case 1: //DNI
                     $this->populateFieldWithValue("dni", 'X');
                    breaK;
                case 6: // Pasaporte
                    $this->populateFieldWithValue(" pasaporte", 'X');
                    breaK;
                case 3: // LE
                    $this->populateFieldWithValue("l.e", 'X');
                    breaK;
                case 4: // LC
                    $this->populateFieldWithValue("l.c", 'X');
                    breaK;
                case 5: // CI
                    $this->populateFieldWithValue("c.i", 'X');
                    breaK;
            }
            $id_number = $d['Representative']['identification_number'];
            $this->populateFieldWithValue("numero", $id_number);
            $this->populateFieldWithValue("autoridad", $d['Representative']['nationality']);
        }

        // este no se imprime
        //$this->populateFieldWithValue("fecha, sello ...", $d["Model"]["fieldname"]);


        $this->populateFieldWithValue("apellido y nombre", $d["F11"]["nombre_del_conyuge"]);
        
        if (!empty($d['Spouse'])) {
            $s = $d['Spouse'];
            $this->populateFieldWithValue("apellido y nombre conyuge", $s["name"]);
            
            switch ($s['identification_type_id']){
                case 1: //DNI
                     $this->populateFieldWithValue("dni conyuge", 'X');
                    breaK;
                case 6: // Pasaporte
                    $this->populateFieldWithValue("pasaporte conyuge", 'X');
                    breaK;
                case 3: // LE
                    $this->populateFieldWithValue("l.e conyuge", 'X');
                    breaK;
                case 4: // LC
                    $this->populateFieldWithValue("l.c conyuge", 'X');
                    breaK;
                case 5: // CI
                    $this->populateFieldWithValue("c.i conyuge", 'X');
                    breaK;
            }

            $this->populateFieldWithValue("numero conyuge", $s["identification_number"]);
            $this->populateFieldWithValue("autoridad conyuge", $s["identification_autority"]);
            //$this->populateFieldWithValue("fecha y sello", $d["Model"]["fieldname"]);
        }

        if ($d["F11"]["tipo_entrega"] == 'posesion'){
            $this->populateFieldWithValue("entrega posesion", 'X');
            //$this->populateFieldWithValue("entrega tenencia", '');
        } else {
            $this->populateFieldWithValue("entrega tenencia", 'X');
        }
    }
}

?>
