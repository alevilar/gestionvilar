<?php
class MaritalStatus extends AppModel {
	var $name = 'MaritalStatus';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'CustomerType' => array(
			'className' => 'CustomerType',
			'foreignKey' => 'marital_status_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>