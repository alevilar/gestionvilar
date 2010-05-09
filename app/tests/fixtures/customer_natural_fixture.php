<?php
/* CustomerNatural Fixture generated on: 2010-05-08 18:05:07 : 1273354987 */
class CustomerNaturalFixture extends CakeTestFixture {
	var $name = 'CustomerNatural';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'surname' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'marital_status_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'nuptials' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'spouse' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_clientes_estado_civiles' => array('column' => 'marital_status_id', 'unique' => 0), 'fk_tipo_personas_customers' => array('column' => 'customer_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'customer_id' => 1,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'surname' => 'Lorem ipsum dolor sit amet',
			'marital_status_id' => 1,
			'nuptials' => 'Lorem ipsum dolor sit amet',
			'spouse' => 'Lorem ipsum dolor sit amet',
			'created' => '1273354987',
			'modified' => '1273354987'
		),
	);
}
?>