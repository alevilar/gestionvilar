<?php
/* Representative Fixture generated on: 2010-05-05 20:05:18 : 1273103598 */
class RepresentativeFixture extends CakeTestFixture {
	var $name = 'Representative';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'surname' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_apoderados_clientes1' => array('column' => 'customer_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'surname' => 'Lorem ipsum dolor sit amet',
			'customer_id' => 1
		),
	);
}
?>