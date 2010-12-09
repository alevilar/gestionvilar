<?php
class FieldFormField extends AppModel {
	var $name = 'FieldFormField';
	var $validate = array(
		'field_form_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'field_coordenate_id' => array(
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
		'FieldForm' => array(
			'className' => 'FieldForm',
			'foreignKey' => 'field_form_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FieldCoordenate' => array(
			'className' => 'FieldCoordenate',
			'foreignKey' => 'field_coordenate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);


        /**
         *  Me devuelve todas las coordenadas para un formulario en especial y una pagina en concreto
         * @param integer $field_form_id
         * @param integer $page
         * @return array find all
         */
        function getCoorFrom($field_form_id, $pageNumber) {
            $fc =  $this->find('all', array(
                'contain' => array('FieldCoordenate.FieldType'),
                'conditions' => array(
                    'FieldCoordenate.page' => $pageNumber,
                    'FieldFormField.field_form_id' => $field_form_id,
                ),
            ));
            
            foreach ($fc as &$f) {
                $f['FieldCoordenate']['value'] = $f['FieldFormField']['value'];
                $f['FieldType'] = $f['FieldCoordenate']['FieldType'];
                unset($f['FieldCoordenate']['FieldType']);
            }
            return $fc;
        }
}
?>