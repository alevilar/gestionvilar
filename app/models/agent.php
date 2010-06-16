<?php
class Agent extends AppModel {
	var $name = 'Agent';
	var $displayField = 'name';

        var $virtualFields = array('name' => 'CONCAT(Agent.surname, " ", Agent.first_name)');

	var $validate = array(
		'identification_type_id' => array(
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
		)
	);
}
?>