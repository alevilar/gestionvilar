<?php
/* Identification Fixture generated on: 2010-05-05 20:05:17 : 1273103597 */
class IdentificationFixture extends CakeTestFixture {
	var $name = 'Identification';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'identification_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'authority_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_identificaciones_clientes1' => array('column' => 'customer_id', 'unique' => 0), 'fk_identifications_identification_types1' => array('column' => 'identification_type_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'identification_type_id' => 1,
			'number' => 'Lorem ipsum dolor sit amet',
			'authority_name' => 'Lorem ipsum dolor sit amet',
			'customer_id' => 1
		),
	);
}
?>