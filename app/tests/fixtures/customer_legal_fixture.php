<?php
/* CustomerLegal Fixture generated on: 2010-05-08 18:05:30 : 1273354830 */
class CustomerLegalFixture extends CakeTestFixture {
	var $name = 'CustomerLegal';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'inscription_entity' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'inscription_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'inscription_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_tipo_personas_clientes1' => array('column' => 'customer_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'customer_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'inscription_entity' => 'Lorem ipsum dolor sit amet',
			'inscription_number' => 'Lorem ipsum dolor sit amet',
			'inscription_date' => '2010-05-08',
			'created' => '1273354830',
			'modified' => '1273354830'
		),
	);
}
?>