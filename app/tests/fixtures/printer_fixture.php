<?php
/* Printer Fixture generated on: 2010-07-05 01:07:03 : 1278303363 */
class PrinterFixture extends CakeTestFixture {
	var $name = 'Printer';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'x' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'y' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'x' => 1,
			'y' => 1,
			'created' => '1278303363',
			'modified' => '1278303363'
		),
	);
}
?>