<?php
/* Spouse Fixture generated on: 2010-05-08 18:05:29 : 1273355069 */
class SpouseFixture extends CakeTestFixture {
	var $name = 'Spouse';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 120),
		'identification_type_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'identification_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'customer_natural_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_spouses_customer_naturals' => array('column' => 'customer_natural_id', 'unique' => 0), 'fk_spouses_identification_types' => array('column' => 'identification_type_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'identification_type_id' => 1,
			'identification_number' => 'Lorem ipsum dolor sit amet',
			'created' => '1273355069',
			'modified' => '1273355069',
			'customer_natural_id' => 1
		),
	);
}
?>