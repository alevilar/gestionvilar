<?php

class F12 extends AppModel{
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


    var $belongsTo = array('Vehicle', 'Representative');
}

?>
