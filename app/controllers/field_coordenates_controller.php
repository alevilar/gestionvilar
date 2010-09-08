<?php
class FieldCoordenatesController extends AppController {

	var $name = 'FieldCoordenates';

	function index() {
            $condiciones = array();
            $limit = 30;
                if (!empty($this->passedArgs['field_creator_id'])) {
                    $condiciones = array("FieldCoordenate.field_creator_id"=>$this->passedArgs['field_creator_id']);
                    $limit = 999999;
                }
                if (!empty($this->data['FieldCoordenate'])){
                    foreach ($this->data['FieldCoordenate'] as $campo=>$buscar){
                        $condiciones = array("FieldCoordenate.$campo"=>$buscar);
                        $limit = 999999;
                        $this->passedArgs = array_merge($this->passedArgs,array($campo=>$buscar));
                    }
                }
		$this->FieldCoordenate->recursive = 0;
                $this->paginate = array(
                    'limit'=>$limit,
                    'conditions'=> $condiciones,
                    'order'=>'FieldCoordenate.id ASC',
                );
                $fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
                $this->set(compact('fieldCreators'));
		$this->set('fieldCoordenates', $this->paginate());
	}


        function mapear(){
           // $cond = array ('FieldCoordenate.field_creator_id'=>$field_creator_id);
            $res = $this->FieldCoordenate->find('all', array(

                'order' => array(
                    'FieldCoordenate.field_creator_id',
                    "RPAD(FieldCoordenate.name,1,'?')",
                    'FieldCoordenate.id'),
                ));
            $this->set('res', $res);
        }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'field coordenate'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fieldCoordenate', $this->FieldCoordenate->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FieldCoordenate->create();
			if ($this->FieldCoordenate->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field coordenate'));
				$this->redirect(array('action' => 'index/field_creator_id:'.$this->data['FieldCoordenate']['field_creator_id']));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field coordenate'));
			}
		}
		$fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
                $fieldCoordenates = $this->FieldCoordenate->find('list', array('field'=>array('FieldCoordenate.id','CONCAT(FieldCoordenate.name, " ",FieldCoordenate.field_creator_id)')));
		$fieldTypes = $this->FieldCoordenate->FieldType->find('list');
		$this->set(compact('fieldCreators', 'fieldTypes', 'fieldCoordenates'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'field coordenate'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FieldCoordenate->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field coordenate'));
				$this->redirect(array('action' => 'index/field_creator_id:'.$this->data['FieldCoordenate']['field_creator_id']));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field coordenate'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FieldCoordenate->read(null, $id);
		}

                $fieldCoordenates = $this->FieldCoordenate->find('list', array('conditions'=>array('FieldCoordenate.field_creator_id'=>$this->data['FieldCoordenate']['field_creator_id'])));

                $camposUsados = $this->FieldCoordenate->find('list', array(
                    'fields' => array('id','related_field_table'),
                    'conditions'=>array(
                        'FieldCoordenate.field_creator_id'=>$this->data['FieldCoordenate']['field_creator_id'],
                        'FieldCoordenate.related_field_table IS NOT NULL',
                        )));

		$fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
		$fieldTypes = $this->FieldCoordenate->FieldType->find('list');
		$this->set(compact('fieldCreators', 'fieldTypes', 'fieldCoordenates', 'camposUsados'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'field coordenate'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FieldCoordenate->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Field coordenate'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Field coordenate'));
		$this->redirect(array('action' => 'index'));
	}
}
?>