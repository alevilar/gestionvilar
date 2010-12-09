<?php
/* F04 Fixture generated on: 2010-06-12 20:06:49 : 1276387009 */
class F04Fixture extends CakeTestFixture {
	var $name = 'F04';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tipo_tramite' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'vehicle_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'g1_fecha' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'g1_importe' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'g1_acreedor' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'g2_fecha' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'g2_importe' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'g2_acreedor' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'acreedor_prendario_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'observaciones' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'm_autorizo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'm_doc' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'tipo_tramite' => 1,
			'vehicle_id' => 1,
			'g1_fecha' => 'Lorem ipsum dolor ',
			'g1_importe' => 'Lorem ipsum dolor ',
			'g1_acreedor' => 'Lorem ipsum dolor ',
			'g2_fecha' => 'Lorem ipsum dolor ',
			'g2_importe' => 'Lorem ipsum dolor ',
			'g2_acreedor' => 'Lorem ipsum dolor ',
			'acreedor_prendario_id' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'm_autorizo' => 'Lorem ipsum dolor sit amet',
			'm_doc' => 'Lorem ipsum dolor sit amet',
			'created' => '1276387009',
			'modified' => '1276387009'
		),
	);
}
?>