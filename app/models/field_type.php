<?php
class FieldType extends AppModel {
	var $name = 'FieldType';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'FieldCoordenate' => array(
			'className' => 'FieldCoordenate',
			'foreignKey' => 'field_type_id',
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