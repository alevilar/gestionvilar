<?php

App::import('Lib', 'FormSkeleton');

class F59m extends FormSkeleton {
    var $name = 'F59m';
    var $useTable = 'f59ms';
    
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

    var $belongsTo = array('Agent','Vehicle');


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 16;
    }


    function setSContain() {
        $this->sContain = array(
            'Agent'=>array(
                'IdentificationType'
                ),
            'Vehicle'=>array(
                'Customer'=>array(
                    'CustomerHome',
                    'CustomerNatural',
                    'CustomerLegal',
                    )
                )
            );
    }


    function getViewVars() {
        $cosasParaver = parent::getViewVars();

        $agents['agents'] = $this->Agent->find('list');
        return $cosasParaver + $agents;
        return array();
    }




    function getFormImputs($data){
        $capos = array(
            array(
           'legend'=> '"A" DATOS DEL MANDATARIO / EMPLEADO',
                 'agent_id'=> array('empty'=>'Seleccione'),
                'mandatario_apellidos',
                'mandatario_nombre',
                'mandatario_identification',
                'mandatario_domicilio',
                'mandatario_domicilio_numero',
                'mandatario_domicilio_piso',
                'mandatario_domicilio_dpto',
                'mandatario_localidad',
                'mandatario_provincia',
                'mandatario_cp',
                'mandatario_matricula',
                'mandatario_matricula_mandatario',
            ),
            array(
            'legend'=> '"B" TRAMITE PRESENTADO',
                'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                'vehiculo_dominio',
                'tramite',
                'solicitud_tipo',
                'n_control',
            ),
            array(
             'legend'=> '"C" OBSERVACIONES',
                'observaciones',
            )
           
        );
        return $capos;
    }

    

    function mapDataPage1() {
        /*
        $d = $this->data;

        $this->populateFieldWithValue("apellido", $d["Agent"]["surname"]);
        $this->populateFieldWithValue("nombre", $d["Agent"]["first_name"]);
        $this->populateFieldWithValue("dni", $d["Agent"]['IdentificationType']['name']. ' '.$d["Agent"]['identification_number']);
        $this->populateFieldWithValue("domicilio", $d["Agent"]["address"]);
        $this->populateFieldWithValue("numero", $d["Agent"]["address_number"]);
        $this->populateFieldWithValue("piso", $d["Agent"]["address_floor"]);
        $this->populateFieldWithValue("depto", $d["Agent"]["address_apartment"]);
        $this->populateFieldWithValue("localidad", $d["Agent"]["city"]);
        $this->populateFieldWithValue("provincia", $d["Agent"]["county"]);
        $this->populateFieldWithValue("cod post", $d["Agent"]["postal_code"]);
        $this->populateFieldWithValue("matricula", $d["Agent"]["license"]);
        $this->populateFieldWithValue("mat manda", $d["Agent"]["super_license"]);

        $this->populateFieldWithValue("dominio", $d["vehicle"]["patente"]);
        $this->populateFieldWithValue("tramite", $d["F59m"]["tramite"]);
        $this->populateFieldWithValue("solicitud", $d["F59m"]["solicitud_tipo"]);
        $this->populateFieldWithValue("control", $d["F59m"]["n_control"]);
        $this->populateFieldWithValue("observaciones", $d["F59m"]["observaciones"]);
         */
    }


    function mapDataPage2() {

    }
}
?>