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


    var $belongsTo = array('Vehicle');


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 0;
    }


    function setSContain() {
        $this->sContain = null;
    }


    function mapData() {
       
    }
}

?>
