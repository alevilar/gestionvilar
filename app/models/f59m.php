<?php

App::import('Lib', 'FormSkeleton');

class F59m extends FormSkeleton {
    var $name = 'F59m';
    
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
        $this->sContain = array('Agent'=>array(),'Vehicle'=>array('Customer'=>array('CustomerHome','CustomerNatural','CustomerLegal')));
    }


    function getViewVars() {
        $cosasParaver = parent::getViewVars();

        $agents['agents'] = $this->Agent->find('list');
        return $cosasParaver + $agents;
        return array();
    }


    function mapDataPage1() {

    }


    function mapDataPage2() {

    }
}
?>