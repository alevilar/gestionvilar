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
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'y' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
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
         *  Me devuelve todas las coordenadas para un formulario en especial y una pagina en concreto
         * @param integer $field_creator_id
         * @param integer $page
         * @return array find all
         */
        function getCoorFrom($field_creator_id, $page) {
            return $this->find('all', array(
                'conditions'=>array(
                        'FieldCoordenate.field_creator_id'=>(int)$field_creator_id,
                        'FieldCoordenate.page'=>$page,
                ),
                'contain'=>array('FieldType','FieldContinue')
            ));
        }
}
?>