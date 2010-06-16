<?php
/* Agent Fixture generated on: 2010-06-12 20:06:16 : 1276387156 */
class AgentFixture extends CakeTestFixture {
	var $name = 'Agent';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'surname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'identification_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'identification_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'address_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'address_floor' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 8),
		'address_apartment' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 8),
		'city' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'county' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'license' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'super_license' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'state' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_agents_identification_types1' => array('column' => 'identification_type_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'surname' => 'Lorem ipsum dolor sit amet',
			'identification_type_id' => 1,
			'identification_number' => 'Lorem ipsum dolor sit amet',
			'address' => 'Lorem ipsum dolor sit amet',
			'address_number' => 'Lorem ip',
			'address_floor' => 'Lorem ',
			'address_apartment' => 'Lorem ',
			'city' => 'Lorem ipsum dolor sit amet',
			'county' => 'Lorem ipsum dolor sit amet',
			'license' => 'Lorem ipsum dolor sit amet',
			'super_license' => 'Lorem ipsum dolor sit amet',
			'state' => 'Lorem ipsum dolor sit amet',
			'modified' => '1276387156',
			'created' => '1276387156'
		),
	);
}
?>