<?php
class State extends AppModel {
	var $name = 'State';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'County' => array(
			'className' => 'County',
			'foreignKey' => 'state_id',
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