<?php
class IdentificationTypesController extends AppController {

	var $name = 'IdentificationTypes';

	function index() {
		$this->IdentificationType->recursive = 0;
		$this->set('identificationTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'identification type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('identificationType', $this->IdentificationType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->IdentificationType->create();
			if ($this->IdentificationType->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'identification type'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identification type'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'identification type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->IdentificationType->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'identification type'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identification type'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->IdentificationType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'identification type'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->IdentificationType->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Identification type'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Identification type'));
		$this->redirect(array('action' => 'index'));
	}
}
?>