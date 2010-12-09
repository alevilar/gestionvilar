<?php
class Identification extends AppModel {
	var $name = 'Identification';
	var $displayField = 'number';
	var $validate = array(
		'customer_id' => array(
                        'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'debe existir solo una identificación por cliente',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'IdentificationType' => array(
			'className' => 'IdentificationType',
			'foreignKey' => 'identification_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>