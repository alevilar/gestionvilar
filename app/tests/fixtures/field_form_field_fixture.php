<?php
/* FieldFormField Fixture generated on: 2010-10-06 02:10:03 : 1286341563 */
class FieldFormFieldFixture extends CakeTestFixture {
	var $name = 'FieldFormField';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'field_form_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'field_coordenate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'value' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'field_form_id' => 1,
			'field_coordenate_id' => 1,
			'value' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>