<?php
/* CustomerType Fixture generated on: 2010-05-05 20:05:17 : 1273103597 */
class CustomerTypeFixture extends CakeTestFixture {
	var $name = 'CustomerType';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'surname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'marital_status_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'nuptials' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'spouse' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'inscription_entity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'inscription_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'inscription_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_clientes_estado_civiles' => array('column' => 'marital_status_id', 'unique' => 0), 'fk_tipo_personas_clientes1' => array('column' => 'customer_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'customer_id' => 1,
			'type' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'surname' => 'Lorem ipsum dolor sit amet',
			'marital_status_id' => 1,
			'nuptials' => 'Lorem ipsum dolor sit amet',
			'spouse' => 'Lorem ipsum dolor sit amet',
			'inscription_entity' => 'Lorem ipsum dolor sit amet',
			'inscription_number' => 'Lorem ipsum dolor sit amet',
			'inscription_date' => '2010-05-05',
			'created' => '1273103597',
			'modified' => '1273103597'
		),
	);
}
?>