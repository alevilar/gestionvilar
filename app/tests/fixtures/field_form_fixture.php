<?php
/* FieldForm Fixture generated on: 2010-10-06 02:10:47 : 1286341667 */
class FieldFormFixture extends CakeTestFixture {
	var $name = 'FieldForm';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'field_creator_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'field_creator_id' => 1,
			'created' => '1286341667',
			'modified' => '1286341667'
		),
	);
}
?>