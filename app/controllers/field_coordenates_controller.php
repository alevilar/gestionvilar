<?php

class FieldCoordenatesController extends AppController
{

    var $name = 'FieldCoordenates';
    var $belongsTo = array(
        'CharacterType'
    );
    var $fieldNames = array(
        'Personas' => array(
            'porcentaje' => 'porcentaje',
            'name' => 'name',
            'ocupation' => 'ocupation',
            'cuit_cuil' => 'cuit_cuil',
            'email' => 'email',
            'phone_number' => 'phone_number',
            'born_place' => 'born_place',
            "id" => "id",
            "customer_id" => "customer_id",
            "persona_fisica_o_juridica" => "persona_fisica_o_juridica",
        ),
        'Personas Físicas' => array(
            "character_type_id" => "character_type_id",
            "nationality_type_id" => "nationality_type_id",
            "fecha_nacimiento" => "fecha_nacimiento",
            'anio_nacimiento' => 'anio_nacimiento',
            'mes_nacimiento' => 'mes_nacimiento',
            'dia_nacimiento' => 'dia_nacimiento',
            'fecha_inscripcion' => 'fecha_inscripcion',
            "marital_status_id" => "marital_status_id",
            "casado" => "casado",
            "soltero" => "soltero",
            "viudo" => "viudo",
            "divorciado" => "divorciado",
            "nupcia" => "nupcia",
        ),
        'Personas Jurídicas' => array(
            'personeria_otorgada' => 'personeria_otorgada',
            'inscripcion' => 'inscripcion',
            'anio_inscripcion' => 'anio_inscripcion',
            'mes_inscripcion' => 'mes_inscripcion',
            'dia_inscripcion' => 'dia_inscripcion',
            'fecha_inscripcion' => 'fecha_inscripcion',
            "apoderado_name" => "apoderado_name",
            "apoderado_identification_type_id" => "apoderado_identification_type_id",
            "apoderado_identification_number" => "apoderado_identification_number",
            "apoderado_nationality_type" => "apoderado_nationality_type",
            "apoderado_nationality" => "apoderado_nationality",
        ),
        'Identificacion' => array(
            "identification_authority" => "identification_authority",
            'identification_auth' => 'identification_auth',
            'identification_type_id' => 'identification_type_id',
            'identification_dni' => 'identification_dni',
            'identification_ci' => 'identification_ci',
            'identification_dni_ext' => 'identification_dni_ext',
            'identification_lc' => 'identification_lc',
            'identification_le' => 'identification_le',
            'identification_pasap' => 'identification_pasap',
            'identification_number' => 'identification_number',
        ),
        'Personas -> Cónyuge' => array(
            "conyuge" => "conyuge",
            "conyuge_apoderado_name" => "conyuge_apoderado_name",
            "conyuge_apoderado_identification_type_id" => "conyuge_apoderado_identification_type_id",
            "conyuge_apoderado_identification_number" => "conyuge_apoderado_identification_number",
            "conyuge_apoderado_nationality_type" => "conyuge_apoderado_nationality_type",
            "conyuge_apoderado_identification_auth" => "conyuge_apoderado_identification_auth",
        ),
        'Personas -> Apoderado' => array(
            'apoderado_name' => 'apoderado_name',
            'apoderado_identification_type_id' => 'apoderado_identification_type_id',
            'apoderado_identification_number' => 'apoderado_identification_number',
            'apoderado_nationality_type' => 'apoderado_nationality_type',
            'apoderado_nationality' => 'apoderado_nationality',
            
            "apoderado_identification_authority" => "identification_authority",
            'apoderado_identification_auth' => 'identification_auth',
            'apoderado_identification_dni' => 'identification_dni',
            'apoderado_identification_ci' => 'identification_ci',
            'apoderado_identification_dni_ext' => 'identification_dni_ext',
            'apoderado_identification_lc' => 'identification_lc',
            'apoderado_identification_le' => 'identification_le',
            'apoderado_identification_pasap' => 'identification_pasap',
        ),
        'Vehículo' => array(
            'patente' => 'patente',
            'type' => 'type',
            'use' => 'use',
            'number' => 'number',
            'motor_number' => 'motor_number',
            'motor_brand' => 'motor_brand',
            'model' => 'model',
            'fabrication_certificate' => 'fabrication_certificate',
            'chasis_number' => 'chasis_number',
            'chasis_brand' => 'chasis_brand',
            'brand' => 'brand',
            'adquisition_value' => 'adquisition_value',
            'adquisition_dia' => 'adquisition_dia',
            'adquisition_mes' => 'adquisition_mes',
            'adquisition_anio' => 'adquisition_anio',
            'adquisition_evidence_element' => 'adquisition_evidence_element',
        ),
        'Domicilios DEFAULT' => array(
            'home_address' => 'calle',
            'home_number' => 'numero_calle',
            'home_floor' => 'piso',
            'home_apartment' => 'depto',
            'home_postal_code' => 'cp',
            'home_city' => 'localidad',
            'home_county' => 'departamento',
            'home_state' => 'provincia',
        ),
    );
    
    
    function beforeFilter()
    {
        parent::beforeFilter();
        
        $home = ClassRegistry::init('CustomerHome');
        
        $tiposHomes = $home->find('list', array(
            'group' => array('type'),
            'fields' => array('type'),
            'recursive' => -1
        ));
        
        foreach ($tiposHomes as $t ) {
            $t = strtolower($t);
            $this->fieldNames["Domicilios -> $t"] = array(
                "home_".$t."_address" => 'calle',
                "home_".$t."_number" => 'numero_calle',
                "home_".$t."_floor" => 'piso',
                "home_".$t."_apartment" => 'depto',
                "home_".$t."_postal_code" => 'cp',
                "home_".$t."_city" => 'localidad',
                "home_".$t."_county" => 'departamento',
                "home_".$t."_state" => 'provincia',
            );
        }
    }

    /**
     *
     * @param string $simpleView  if "advanced" then renders index_advanced for having a moore complicated UI
     */
    function index($simpleView = 'index')
    {
        $condiciones = array();

        if (!$this->Session->read("FieldCoordenate.page")) {
            $this->Session->write("FieldCoordenate.page",1);
        }

        if (!empty($this->passedArgs['field_creator_id'])) {
            $condiciones["FieldCoordenate.field_creator_id"] = $this->passedArgs['field_creator_id'];
        }

        if ( !empty($this->passedArgs['page'])) {
            $this->Session->write("FieldCoordenate.page", $this->passedArgs['page']);
        }

        if (!empty($this->passedArgs['FieldCoordenate.name'])) {
            $condiciones["FieldCoordenate.name LIKE"] = '%'.$this->passedArgs['FieldCoordenate.name'].'%';
        }

        if (!empty($this->data['FieldCoordenate'])) {
            foreach ($this->data['FieldCoordenate'] as $campo => $buscar) {
                $schema = $this->FieldCoordenate->schema();
                if ($schema[$campo]['type'] == 'string'){
                    $condiciones["FieldCoordenate.$campo LIKE"] = "%$buscar%";
                } else {
                    $condiciones["FieldCoordenate.$campo"] = $buscar;
                }
                $this->Session->write("FieldCoordenate.$campo", $buscar);
                $this->passedArgs = array_merge($this->passedArgs, array($campo => $buscar));
            }
        } else {
            if ($fcId = $this->Session->read('FieldCoordenate.field_creator_id')) {
                $condiciones['FieldCoordenate.field_creator_id'] = $fcId;
            }
            $this->data['FieldCoordenate']['field_creator_id'] = $fcId;
        }

        $character_types = ClassRegistry::init('CharacterType')->find('list', array('fields' => array('field_name', 'name'))) + array('vehicle' => 'Vehicle');
        $this->set('character_types', $character_types);

        if (empty($this->passedArgs['page'])) {
            $this->passedArgs['page'] = $this->Session->read("FieldCoordenate.page");
        }
    
        $this->FieldCoordenate->recursive = 0;
        $this->paginate = array(
            'page' => 1,
            'conditions' => $condiciones,
            'order' => 'FieldCoordenate.id ASC',
        );
        $fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
        $fieldTypes = $this->FieldCoordenate->FieldType->find('list');
        $related_field_table_selects = $this->fieldNames;
        foreach ($this->fieldNames as $title => $opsG) {
            foreach ($opsG as $campillo=>$nombre) {
                $related_field_table_selects[$campillo] = $title . ": " . $nombre;
            }
        }
        $this->set(compact('fieldCreators', 'fieldTypes', 'related_field_table_selects'));
        $this->set('fieldCoordenates', $this->paginate());

        if ( $simpleView != 'index') {
            $this->render('index_advanced');
        }
    }

    function update()
    {
        $this->FieldCoordenate->id = $this->params['form']['field_coordenate_id'];
        $this->FieldCoordenate->set($this->params['form']['field'], $this->params['form']['value']);
        if ($this->FieldCoordenate->save()) {
            $txtShow = (!empty($this->params['form']['text'])) ? $this->params['form']['text'] : $this->params['form']['value'];
            echo $txtShow;
        } else {
            echo "error al guardar";
        }
        exit;
    }

    /**
     * Genera codigo fuente php para crear facilmente los Models de Cake
     * @param <type> $field_creator_id
     */
    function mapear($field_creator_id)
    {
        $res = $this->FieldCoordenate->FieldCreator->read(null, $field_creator_id);
        $actoresInvolucrados = $this->FieldCoordenate->query("
                                select distinct character_type from field_coordenates  FieldCoordenate
                                where field_creator_id = $field_creator_id
                                and character_type in (
                                    select field_name from character_types
                                )");
        $i = 0;
        $acts = array();
        foreach ($actoresInvolucrados as $ai) {
            if ($i != 0)
                echo ",";
            $aaCC = $ai['FieldCoordenate']['character_type'];
            $acts[] = "'$aaCC'";
        }

        $this->set('actoresInvolucrados', $acts);
        $this->set('res', $res);
    }

    function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'field coordenate'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('fieldCoordenate', $this->FieldCoordenate->read(null, $id));
    }

    function add()
    {
        if (!empty($this->data)) {
            $this->FieldCoordenate->create();
            if ($this->FieldCoordenate->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field coordenate'));
                $this->redirect(array('action' => 'index/field_creator_id:' . $this->data['FieldCoordenate']['field_creator_id']));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field coordenate'));
            }
        }


        if ($fcId = $this->Session->read('FieldCoordenate.field_creator_id')) {
            $condiciones['FieldCoordenate.field_creator_id'] = $fcId;
        }
        $this->data['FieldCoordenate']['field_creator_id'] = $fcId;

        $character_types = ClassRegistry::init('CharacterType')->find('list', array('fields' => array('field_name', 'name'))) + array('vehicle' => 'Vehicle');
        $fieldTableList = $this->fieldNames;

        $fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
        $fieldCoordenates = $this->FieldCoordenate->find('list', array('field' => array('FieldCoordenate.id', 'CONCAT(FieldCoordenate.name, " ",FieldCoordenate.field_creator_id)')));
        $fieldTypes = $this->FieldCoordenate->FieldType->find('list');
        $this->set(compact('fieldCreators', 'fieldTypes', 'fieldCoordenates', 'fieldTableList', 'character_types'));
    }

    function edit($id = null)
    {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'field coordenate'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->FieldCoordenate->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field coordenate'));
                $this->redirect(array('action' => 'index/field_creator_id:' . $this->data['FieldCoordenate']['field_creator_id']));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field coordenate'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->FieldCoordenate->read(null, $id);
        }

        $fieldCoordenates = $this->FieldCoordenate->find('list', array('conditions' => array('FieldCoordenate.field_creator_id' => $this->data['FieldCoordenate']['field_creator_id'])));

        $camposUsados = $this->FieldCoordenate->find('list', array(
                    'fields' => array('id', 'related_field_table'),
                    'conditions' => array(
                        'FieldCoordenate.field_creator_id' => $this->data['FieldCoordenate']['field_creator_id'],
                        'FieldCoordenate.related_field_table IS NOT NULL',
                        )));

        $character_types = ClassRegistry::init('CharacterType')->find('list', array('fields' => array('field_name', 'name'))) + array('vehicle' => 'Vehicle');
        $fieldTableList = $this->fieldNames;

        $fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
        $fieldTypes = $this->FieldCoordenate->FieldType->find('list');

        $fieldSelectNames = $this->fieldNames;

        $this->set(compact('fieldTableList', 'fieldCreators', 'fieldTypes', 'fieldCoordenates', 'camposUsados', 'character_types','fieldSelectNames'));
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'field coordenate'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->FieldCoordenate->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'Field coordenate'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Field coordenate'));
        $this->redirect(array('action' => 'index'));
    }

}

?>