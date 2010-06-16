<?php
/* F08 Fixture generated on: 2010-06-12 20:06:10 : 1276387090 */
class F08Fixture extends CakeTestFixture {
	var $name = 'F08';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'a_lugar_contrato' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'a_precio_compra' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'vehicle_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'representative_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'spouse_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'observaciones' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'condominium_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'vendedor_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'vendedor_condominium_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'o_autorizado_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'o_tipo_y_num_doc' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_f01s_vehicles1' => array('column' => 'vehicle_id', 'unique' => 0), 'fk_f01s_representatives1' => array('column' => 'representative_id', 'unique' => 0), 'fk_f01s_condominiums1' => array('column' => 'condominium_id', 'unique' => 0), 'fk_f01s_spouses1' => array('column' => 'spouse_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'a_lugar_contrato' => 'Lorem ipsum dolor sit amet',
			'a_precio_compra' => 'Lorem ipsum dolor sit amet',
			'vehicle_id' => 1,
			'representative_id' => 1,
			'spouse_id' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'condominium_id' => 1,
			'vendedor_id' => 1,
			'vendedor_condominium_id' => 1,
			'o_autorizado_name' => 'Lorem ipsum dolor sit amet',
			'o_tipo_y_num_doc' => 'Lorem ipsum dolor sit amet',
			'created' => '1276387090',
			'modified' => '1276387090'
		),
	);
}
?>