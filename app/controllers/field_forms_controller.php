<?php
class FieldFormsController extends AppController {

	var $name = 'FieldForms';

	function index() {
		$this->FieldForm->recursive = 0;
		$this->set('fieldForms', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'field form'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fieldForm', $this->FieldForm->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FieldForm->create();
			if ($this->FieldForm->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field form'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field form'));
			}
		}
		$fieldCreators = $this->FieldForm->FieldCreator->find('list');
		$this->set(compact('fieldCreators'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'field form'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FieldForm->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field form'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field form'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FieldForm->read(null, $id);
		}
		$fieldCreators = $this->FieldForm->FieldCreator->find('list');
		$this->set(compact('fieldCreators'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'field form'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FieldForm->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Field form'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Field form'));
		$this->redirect(array('action' => 'index'));
	}
}
?>