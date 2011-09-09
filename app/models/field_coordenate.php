<?php
class FieldCoordenate extends AppModel {
	var $name = 'FieldCoordenate';
	var $displayField = 'name';

        var $order = array('FieldCoordenate.id DESC');

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
                    'norepe' => array(
				'rule' => array('norepe'),
				'message' => 'Éste nombre ya fue ingresado, no se puede repetir el nombre para el mismo formulario',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'x' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'y' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'field_creator_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'field_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'w' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'h' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FieldCreator' => array(
			'className' => 'FieldCreator',
			'foreignKey' => 'field_creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FieldType' => array(
			'className' => 'FieldType',
			'foreignKey' => 'field_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'FieldContinue'=> array(
                    'className'=> 'FieldCoordenate',
                    'foreignKey' => 'continue_field_coordenate_id',
                ),
	);

        var $hasMany = array('FieldFormField');


        public function beforeSave($options = array())
        {
            parent::beforeSave($options);

             /**
             * usa el this->data para llenar elcampo 'related_field_table
             * segun el character_type_id y el select del campo 'related_field_table_select
             */

             if ( empty($this->data['FieldCoordenate']['character_type']) ) {
                $character_type = $this->field('character_type');
             } else {
                $character_type = $this->data['FieldCoordenate']['character_type'];
             }

             if ( empty($this->data['FieldCoordenate']['related_field_table_select']) ) {
                $related_field_table_select = $this->field('related_field_table_select');
                if ( empty($related_field_table_select) ) {
                    return true; // guardar, pero no nodificar el campo related_field_table
                }
             } else {
                $related_field_table_select = $this->data['FieldCoordenate']['related_field_table_select'];
             }

             if (!empty($character_type)) {
                 $character_type  = $character_type.'_';
             }
             if (empty($this->data['FieldCoordenate']['related_field_table'])) {
                $this->data['FieldCoordenate']['related_field_table'] = $character_type.$related_field_table_select;
             }
            
             return true;

        }

        function norepe(){
            $this->recursive = -1;
            $trajo = $this->find('count', array(
                'conditions'=>array(
                    'field_creator_id'=>$this->data['FieldCoordenate']['field_creator_id'],
                    'name'=>$this->data['FieldCoordenate']['name'],
                )
            ));
            if ($trajo > 0){
                return false;
            } else {
                return true;
            }
        }

        /**
         *  Devuelve la cantidad de paginas involucradas en este formulario
         * @param integer $field_creator_id
         * @return integer cantidad de paginas
         */
        function getCantPages($field_creator_id) {
            $cond['FieldCoordenate.field_creator_id'] = (int)$field_creator_id;
         

            $fields = array('FieldCoordenate.page');
            
            $ca = $this->find('list', array(
                'conditions'=>$cond,
                'recursive' => -1,
                'fields' => $fields,
                'group'  => $fields,
                'order'  => $fields,
            ));

            return count($ca);
        }


        /**
         *  Me devuelve todas las coordenadas para un formulario en especial y una pagina en concreto
         * @param integer $field_creator_id
         * @param integer $page
         * @return array find all
         */
        function getCoorFrom($field_creator_id, $page = null) {
            $cond['FieldCoordenate.field_creator_id'] = (int)$field_creator_id;
            
            if (!empty($page)) $cond['FieldCoordenate.page'] = $page;
            
            return $this->find('all', array(
                'conditions'=>$cond,
                'contain'=>array('FieldType','FieldContinue')
            ));
        }
}
?>