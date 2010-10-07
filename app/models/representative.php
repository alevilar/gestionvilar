<?php
class Representative extends AppModel {
	var $name = 'Representative';

        var $nationalityTypes = array('argentino'=>'Argentino', 'extranjero'=>'Extranjero');

        var $virtualFields = array('name' => 'CONCAT(Representative.surname, " ", Representative.first_name)');


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

	var $belongsTo = array('Customer','IdentificationType');
}
?>