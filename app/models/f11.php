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


    public function beforeSave($options) {
        parent::beforeSave($options);

        if (!empty($this->data[$this->name])){

            
            switch ($this->data[$this->name]['vendedor_marital_status_id']){
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
            

            switch ($this->data[$this->name]['representative_identification_type_id']){
                 case 1: //DNI
                     $this->data[$this->name]['representative_identification_dni'] = 'X';
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['representative_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['representative_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['representative_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['representative_identification_ci'] = 'X';
                    breaK;
            }


            switch ($this->data[$this->name]['spouse_identification_type_id']){
                 case 1: //DNI
                    $this->data[$this->name]['spouse_identification_dni'] = 'X';
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name]['spouse_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name]['spouse_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name]['spouse_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name]['spouse_identification_ci'] = 'X';
                    breaK;
            }
       }
            
    }



     function getFormImputs($data){
         $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $customerMaritalStatus = '';
        $customerNuptials = '';
        if ($data['Customer']['type'] == 'natural' && !empty($data['Customer']['CustomerNatural'])) {
            $customerMaritalStatus = $data['Customer']['CustomerNatural']['marital_status_id'];
            $customerNuptials = $data['Customer']['CustomerNatural']['nuptials'];
        }

         return array(
             array(
                 'legend'=>'Dominio',
                 'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                 'vehicle_patente'=>array('label'=>'N° de Chapa Patente', 'value'=>$data['Vehicle']['patente'] ),
                 ),
             array(
                 'legend'=>'Vendedor o Transmitente',
                 'vendedor_name'=> array('label'=> 'Apellido y Nombres o Denominación del Vendedor', 'value'=>$data['Customer']['name'], 'class'=>'span-11 clear'),
                 'vendedor_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione', 'value'=>$customerMaritalStatus),
                 'vendedor_nuptials'=> array('div'=>array('class'=>'span-3 clear'), 'class'=>'span-1', 'label'=>'Nupcia N°','value'=>$customerNuptials),
             ),
              array(
                'legend'=>'Indicar datos del comprados o adquiriente y lugar de entega del vehiculo. Si no la recuerda, fecha anticipada',
                 'datos'=>array('label'=>false),
             ),
             array(
                 'legend'=>false,
                 'representative_id',
                 'representative_name',
                 'representative_identification_type_id'=> array('label'=>'Tipo Documento', 'options'=>$identificationsTypes, 'empty'=>'Seleccione'),
                 'representative_identification_autoridad_o_pais',
                 'representative_fecha_firma',
             ),
             array(
                 'legend'=>false,
                 'entrega_posesion',
                 'entrega_tenencia',
             ),
             array(
                 'legend'=>false,
                 'spouse_id',
                 'spouse_name',
                 'spouse_identification_number',
                 'spouse_identification_type_id'=> array('label'=>'Tipo Documento', 'options'=>$identificationsTypes, 'empty'=>'Seleccione'),
                 'spouse_identification_autoridad_o_pais',
                 'spouse_identification_fecha_firma',
             ),
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
