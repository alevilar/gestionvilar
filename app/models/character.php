<?php
class Character extends AppModel {
	var $name = 'Character';
	var $displayField = 'name';

        var $nationalityTypes = array('argentino'=>'Argentino', 'extranjero'=>'Extranjero');

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
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array('CharacterType', 'IdentificationType', 'MaritalStatus', 'Customer');

}
?>