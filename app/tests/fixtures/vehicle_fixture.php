<?php
/* Vehicle Fixture generated on: 2010-04-28 19:04:46 : 1272493606 */
class VehicleFixture extends CakeTestFixture {
	var $name = 'Vehicle';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'fabrication_certificate' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'brand' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'motor_brand' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'motor_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'chasis_brand' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'chasis_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'use' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'adquisition_value' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'adquisition_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'adquisition_evidence_element' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_vehiculos_clientes1' => array('column' => 'customer_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'customer_id' => 1,
			'fabrication_certificate' => 'Lorem ipsum dolor sit amet',
			'brand' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'model' => 'Lorem ipsum dolor sit amet',
			'motor_brand' => 'Lorem ipsum dolor sit amet',
			'motor_number' => 'Lorem ipsum dolor sit amet',
			'chasis_brand' => 'Lorem ipsum dolor sit amet',
			'chasis_number' => 'Lorem ipsum dolor sit amet',
			'use' => 'Lorem ipsum dolor sit amet',
			'adquisition_value' => 'Lorem ipsum dolor sit amet',
			'adquisition_date' => '2010-04-28',
			'adquisition_evidence_element' => 'Lorem ipsum dolor sit amet',
			'created' => '1272493606',
			'modified' => '1272493606'
		),
	);
}
?>