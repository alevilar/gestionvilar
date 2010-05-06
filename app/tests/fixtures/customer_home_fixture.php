<?php
/* CustomerHome Fixture generated on: 2010-05-05 20:05:17 : 1273103597 */
class CustomerHomeFixture extends CakeTestFixture {
	var $name = 'CustomerHome';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'floor' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'apartment' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'postal_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'city_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_domicilios_clientes1' => array('column' => 'customer_id', 'unique' => 0), 'fk_domicilios_localidades1' => array('column' => 'city_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'address' => 'Lorem ipsum dolor sit amet',
			'number' => 'Lorem ipsum dolor sit amet',
			'floor' => 'Lorem ipsum dolor sit amet',
			'apartment' => 'Lorem ipsum dolor sit amet',
			'postal_code' => 'Lorem ipsum dolor sit amet',
			'customer_id' => 1,
			'city_id' => 1
		),
	);
}
?>