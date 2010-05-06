<?php
class CustomerTypesController extends AppController {

	var $name = 'CustomerTypes';

	function index() {
		$this->CustomerType->recursive = 0;
		$this->set('customerTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('customerType', $this->CustomerType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CustomerType->create();
			if ($this->CustomerType->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer type'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer type'));
			}
		}
		$customers = $this->CustomerType->Customer->find('list');
		$maritalStatuses = $this->CustomerType->MaritalStatus->find('list');
		$this->set(compact('customers', 'maritalStatuses'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CustomerType->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer type'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer type'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CustomerType->read(null, $id);
		}
		$customers = $this->CustomerType->Customer->find('list');
		$maritalStatuses = $this->CustomerType->MaritalStatus->find('list');
		$this->set(compact('customers', 'maritalStatuses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'customer type'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CustomerType->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Customer type'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Customer type'));
		$this->redirect(array('action' => 'index'));
	}
}
?>