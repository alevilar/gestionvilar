<?php
class IdentificationsController extends AppController {

	var $name = 'Identifications';

	function index() {
		$this->Identification->recursive = 0;
		$this->set('identifications', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'identification'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('identification', $this->Identification->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Identification->create();
			if ($this->Identification->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'identification'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identification'));
			}
		}
		$identificationTypes = $this->Identification->IdentificationType->find('list');
		$customers = $this->Identification->Customer->find('list');
		$this->set(compact('identificationTypes', 'customers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'identification'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Identification->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'identification'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identification'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Identification->read(null, $id);
		}
		$identificationTypes = $this->Identification->IdentificationType->find('list');
		$customers = $this->Identification->Customer->find('list');
		$this->set(compact('identificationTypes', 'customers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'identification'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Identification->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Identification'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Identification'));
		$this->redirect(array('action' => 'index'));
	}
}
?>