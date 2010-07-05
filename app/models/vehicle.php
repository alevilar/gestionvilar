<?php
class Vehicle extends AppModel {
    var $name = 'Vehicle';
    var $validate = array(
            'customer_id' => array(
                            'numeric' => array(
                                            'rule' => array('numeric'),
                            //'message' => 'Your custom message here',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                            ),
                            'vehicle_type_id' => array(
                                            'rule' => array('notEmpty'),
                                            'message' => array('Debe ingresar un Tipo de Vehiculo.')
                            ),
            ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array('Customer', 'VehicleType');



}
?>