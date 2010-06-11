<?php
/* Character Fixture generated on: 2010-06-08 16:06:02 : 1276023602 */
class CharacterFixture extends CakeTestFixture {
	var $name = 'Character';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'porcentaje' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'calle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'numero_calle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'piso' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'depto' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'cp' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'localidad' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'departamento' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'provincia' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'identification_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'fecha_nacimiento' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'marital_status_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'nupcia' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'conyuge' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'personeria_otorgada' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'inscripcion' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'fecha_inscripcion' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_condominiums_identifications1' => array('column' => 'identification_id', 'unique' => 0), 'fk_condominiums_marital_statuses1' => array('column' => 'marital_status_id', 'unique' => 0), 'fk_condominiums_customers1' => array('column' => 'customer_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'porcentaje' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'calle' => 'Lorem ipsum dolor sit amet',
			'numero_calle' => 'Lorem ipsum dolor sit amet',
			'piso' => 'Lorem ipsum dolor sit amet',
			'depto' => 'Lorem ipsum dolor sit amet',
			'cp' => 'Lorem ipsum dolor sit amet',
			'localidad' => 'Lorem ipsum dolor sit amet',
			'departamento' => 'Lorem ipsum dolor sit amet',
			'provincia' => 'Lorem ipsum dolor sit amet',
			'identification_id' => 1,
			'fecha_nacimiento' => '2010-06-08',
			'marital_status_id' => 1,
			'nupcia' => 1,
			'conyuge' => 'Lorem ipsum dolor sit amet',
			'personeria_otorgada' => 'Lorem ipsum dolor sit amet',
			'inscripcion' => 'Lorem ipsum dolor sit amet',
			'fecha_inscripcion' => '2010-06-08',
			'customer_id' => 1
		),
	);
}
?>