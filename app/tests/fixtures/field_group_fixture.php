<?php
/* FieldGroup Fixture generated on: 2011-06-30 18:06:22 : 1309470262 */
class FieldGroupFixture extends CakeTestFixture {
	var $name = 'FieldGroup';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'field_creator_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'field_creator_id' => 1,
			'created' => '1309470262',
			'modified' => '1309470262'
		),
	);
}
?>