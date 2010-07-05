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
        $agentAux = $this->Agent->find('all', array('contain'=>array('IdentificationType')));
        
        foreach ($agentAux as $au) {
            //debug(json_encode($au));
            $au['Agent']['identification_name'] = $au['IdentificationType']['name'];
            $agents['agentJsonData'][$au['Agent']['id']] = json_encode($au['Agent']);
        }
        return $cosasParaver + $agents;
    }




    /**
     *
     * @return array [nombre del elemento] => array [opciones del elemento]
     */
    function getElements(){
        return array(
            'field_forms/agents_data' => array('vehicle'=>$this->data['Vehicle']),
            //'customer_form_view' => array('customer'=>$this->data['Vehicle']['Customer'])
        );
    }


    function getFormImputs($data){
        $capos = array(
            array(
           'legend'=> '"A" DATOS DEL MANDATARIO / EMPLEADO',
                //'agent_id'=> array('empty'=>'Seleccione'),
                'mandatario_apellidos'=> array('label'=>'Apellidos'),
                'mandatario_nombre'=> array('label'=>'Nombres'),
                'mandatario_identification'=> array('label'=>'Tipo y N° Documento'),
                'mandatario_domicilio'=> array('label'=>'Dirección'),
                'mandatario_domicilio_numero'=> array('label'=>'Número'),
                'mandatario_domicilio_piso'=> array('label'=>'Piso'),
                'mandatario_domicilio_dpto'=> array('label'=>'Departamento'),
                'mandatario_localidad'=> array('label'=>'Localidad'),
                'mandatario_provincia'=> array('label'=>'Provincia'),
                'mandatario_cp'=> array('label'=>'Código Postal'),
                'mandatario_matricula' => array('label'=>'Matrícula'),
                'mandatario_matricula_mandatario' => array('label'=>'Matrícula Mandatario'),
            ),
            array(
            'legend'=> '"B" TRAMITE PRESENTADO',
                'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                'vehiculo_dominio'=> array('label'=>'Dominio', 'value'=>$data['Vehicle']['patente']),
                'tramite'=> array('label'=>'Trámite'),
                'solicitud_tipo'=> array('label'=>'Tipo de Solicitud'),
                'n_control'=> array('label'=>'N° Control'),
            ),
            array(
             'legend'=> '"C" OBSERVACIONES',
                'observaciones'=> array('type'=>'textarea'),
            )
        );
        return $capos;
    }

    

}
?>