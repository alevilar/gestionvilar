<?php
class FieldCoordenatesController extends AppController {

	var $name = 'FieldCoordenates';

	function index() {
		$this->FieldCoordenate->recursive = 0;
		$this->set('fieldCoordenates', $this->paginate());
	}


        function mapear(){
           // $cond = array ('FieldCoordenate.field_creator_id'=>$field_creator_id);
            $res = $this->FieldCoordenate->find('all', array(
                'order' => array('FieldCoordenate.field_creator_id','FieldCoordenate.id'),
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
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field coordenate'));
			}
		}
		$fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
		$fieldTypes = $this->FieldCoordenate->FieldType->find('list');
		$this->set(compact('fieldCreators', 'fieldTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'field coordenate'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FieldCoordenate->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field coordenate'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field coordenate'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FieldCoordenate->read(null, $id);
		}
		$fieldCreators = $this->FieldCoordenate->FieldCreator->find('list');
		$fieldTypes = $this->FieldCoordenate->FieldType->find('list');
		$this->set(compact('fieldCreators', 'fieldTypes'));
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