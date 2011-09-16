<?php
class FieldCreator extends AppModel {
	var $name = 'FieldCreator';
	var $displayField = 'name';
        var $order = array('FieldCreator.name');
        
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
            $prefixesInsertados = array();
            $this->id = $id;
            $setDeCampos = array();
            
            $this->contain(array(
                'FieldCoordenate'
            ));
            $fc = $this->read();
            $count = 0;
            foreach ($fc['FieldCoordenate'] as $f) {
                
                $campoNom = '';
                if (!empty($f['related_field_table'])) {
                    $campoNom = Inflector::slug(low($f['related_field_table']));
                } else {
                    $nomAux = utf8_encode(Inflector::slug(low($f['name'])));
                    if ( ! empty($nomAux)) $campoNom = "`".$nomAux."`";
                }

                $tipoField = 'varchar(64) default NULL';
                if ($f['field_type_id'] == 3) {
                    // es Multi Celda
                    $tipoField = 'text default NULL';
                }
                elseif (substr($campoNom,-3)== '_id') {
                    // es FK clave forania
                    $tipoField = 'int(11) default NULL';
                }
                if (!empty($campoNom) && !empty($tipoField)) $setDeCampos[$campoNom] = $tipoField;

                // meto indentification_type_id como FK si es que hay algun campo DNI; PASS, CI, etc
                if ($campoNom && strpos($campoNom, '_identification_') !== false){
                    $prefix = strstr($campoNom, '_identification', true);
                    if ( !in_array($prefix, $prefixesInsertados) ) {
                         $prefixesInsertados[] = $prefix;
                         $setDeCampos[$prefix."_identification_type_id"] = 'int(11) default NULL';
                    }
                }
                
                $count++;
            }
            
            $tableName = Inflector::tableize($fc['FieldCreator']['model']);

            
            if (!$this->query("DROP TABLE IF EXISTS $tableName;")){
                debug("Error al hacer DROP TABLE");
                return -1;
            }

            $ini_query = "
                CREATE TABLE IF NOT EXISTS $tableName(
                    id int(11) NOT NULL auto_increment PRIMARY KEY,
                    vehicle_id int(11),
                    representative_id int(11),
            ";

            foreach ($setDeCampos as $campo=>$tipoCampo) {
                $ini_query .= $campo.' '.$tipoCampo.',';
                $ini_query .= '
                    ';
            }
            

            $ini_query .=
            "
                    created timestamp NULL default NULL,
                    modified timestamp NULL default NULL
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
            ";

            if ($count > 0) {
                debug($this->query($ini_query));
            }
            Cache::clear();
            return true;
        }




        function actualizarTabla($id){
            Cache::clear();
        
            $prefixesInsertados = array();
            $this->id = $id;
            $setDeCampos = array();

            $this->contain(array(
                'FieldCoordenate'
            ));
            $fc = $this->read();

            $count = 0;
            foreach ($fc['FieldCoordenate'] as $f) {
                $campoNom = '';
                if (!empty($f['related_field_table'])) {
                    $campoNom = Inflector::slug(low($f['related_field_table']));
                } else {
                    $nomAux = utf8_encode(Inflector::slug(low($f['name'])));
                    if ( ! empty($nomAux)) $campoNom = "`".$nomAux."`";
                }

                $tipoField = 'varchar(32) default NULL';
                if ($f['field_type_id'] == 3) {
                    // es Multi Celda
                    $tipoField = 'text default NULL';
                }
                elseif (substr($campoNom,-3)== '_id') {
                    // es FK clave forania
                    $tipoField = 'int(11) default NULL';
                }
                if (!empty($campoNom) && !empty($tipoField)) $setDeCampos[$campoNom] = $tipoField;


                // meto indentification_type_id como FK si es que hay algun campo DNI; PASS, CI, etc
                if (strpos($campoNom, '_identification_') !== false){
                    $prefix = strstr($campoNom, '_identification', true);
                    if ( !in_array($prefix, $prefixesInsertados) ) {
                         $prefixesInsertados[] = $prefix;
                         $setDeCampos[$prefix."_identification_type_id"] = 'int(11) default NULL';
                    }
                }

                $count++;
            }

            $tableName = Inflector::tableize($fc['FieldCreator']['model']);


           
            $ini_query = "
                ALTER TABLE $tableName
            ";

            /* @var $formModel AppModel|Object */
            $formModel =& ClassRegistry::init($fc['FieldCreator']['model']);
            $schema = $formModel->_schema;

            //estos no se deben DROPPEAR
            $noDrop = array('id', 'vehicle_id', 'representative_id', 'created', 'modified');
            
            $primera = true;


            $arrayres = array();
            foreach ($setDeCampos as $campo=>$tipoCampo) {
                $campoaux = str_replace('`', '', $campo);
                
                if (empty($schema[$campoaux])) {
                    if ($primera) {
                        $primera = false;
                    } else {
                        $ini_query .= ',
                            ';
                    }
                    $arrayres['added'][] = $campo;
                    $ini_query .= 'ADD COLUMN '.$campo.' '.$tipoCampo.'';
                }
            }

            $i = 0;
            $tot = count($schema);

             $ini_query .= ';';

            $this->query($ini_query);

            Cache::clear();
            $this->querytxt = $ini_query;
            return $arrayres;
        }

}
?>