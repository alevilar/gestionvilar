<?php
class FieldGroup extends AppModel {
	var $name = 'FieldGroup';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FieldCreator' => array(
			'className' => 'FieldCreator',
			'foreignKey' => 'field_creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'FieldCoordenate' => array(
			'className' => 'FieldCoordenate',
			'foreignKey' => 'field_group_id',
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