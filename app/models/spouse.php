<?php
class Spouse extends AppModel {
	var $name = 'Spouse';
	var $displayField = 'name';

        var $actsAs = array('Containable');

	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'customer_natural_id' => array(
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

	var $belongsTo = array(
		'IdentificationType' => array(
			'className' => 'IdentificationType',
			'foreignKey' => 'identification_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CustomerNatural' => array(
			'className' => 'CustomerNatural',
			'foreignKey' => 'customer_natural_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>