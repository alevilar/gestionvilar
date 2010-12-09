<?php
/* F59m Fixture generated on: 2010-06-12 20:06:28 : 1276387108 */
class F59mFixture extends CakeTestFixture {
	var $name = 'F59m';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tramite' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'solicitud_tipo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'vehicle_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'n_control' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'observaciones' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'tramite' => 'Lorem ipsum dolor sit amet',
			'solicitud_tipo' => 'Lorem ipsum dolor sit amet',
			'vehicle_id' => 1,
			'n_control' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '1276387108',
			'modified' => '1276387108'
		),
	);
}
?>