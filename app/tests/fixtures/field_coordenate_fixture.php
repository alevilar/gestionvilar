<?php
/* FieldCoordenate Fixture generated on: 2010-06-01 00:06:35 : 1275362855 */
class FieldCoordenateFixture extends CakeTestFixture {
	var $name = 'FieldCoordenate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'x' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'y' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'field_creator_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'field_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'w' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'h' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_field_type_fcreators1' => array('column' => 'field_creator_id', 'unique' => 0), 'fk_field_type_field_types1' => array('column' => 'field_type_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'x' => 1,
			'y' => 1,
			'field_creator_id' => 1,
			'field_type_id' => 1,
			'w' => 1,
			'h' => 1
		),
	);
}
?>