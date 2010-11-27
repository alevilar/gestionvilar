<?php
class FieldCreator extends AppModel {
	var $name = 'FieldCreator';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'FieldCoordenate' => array(
			'className' => 'FieldCoordenate',
			'foreignKey' => 'field_creator_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


        function crearTabla($id){
            $this->id = $id;
            $setDeCampos = array();
            
            $this->contain(array(
                'FieldCoordenate'
            ));
            $fc = $this->read();
            $count = 0;
            foreach ($fc['FieldCoordenate'] as $f) {

                if (!empty($f['related_field_table'])) {
                    $campoNom = $f['related_field_table'];
                } else {
                    $campoNom = "`".utf8_encode(Inflector::tableize($f['name']))."`";
                }

                $tipoField = 'varchar(110) default NULL';
                if ($f['field_type_id'] == 3) {
                    // es Multi Celda
                    $tipoField = 'text default NULL';
                }
                elseif (substr($campoNom,-3)== '_id') {
                    // es FK clave forania
                    $tipoField = 'int(11) default NULL';
                }

                $setDeCampos[$campoNom] = $tipoField;
                $count++;
            }
            
            $tableName = Inflector::tableize($fc['FieldCreator']['model']);

            
            if (!$this->query("DROP TABLE IF EXISTS $tableName;")){
                debug("Error al hacer DROP TABLE");
                return -1;
            }

            $ini_query = "
                CREATE TABLE IF NOT EXISTS $tableName(
                    id int(11) NOT NULL auto_increment,
                    vehicle_id int(11),
                    representative_id int(11),
            ";

            foreach ($setDeCampos as $campo=>$tipoCampo) {
                $ini_query .= $campo.' '.$tipoCampo.',';
            }
            

            $ini_query .=
            "
                    created timestamp NULL default NULL,
                    modified timestamp NULL default NULL,
                    PRIMARY KEY  (id)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
            ";

            if ($count > 0) {
                debug($this->query($ini_query));
            }

            return true;
        }

}
?>