<?php
class MaritalStatusesController extends AppController {

	var $name = 'MaritalStatuses';

	function index() {
		$this->MaritalStatus->recursive = 0;
		$this->set('maritalStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'marital status'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('maritalStatus', $this->MaritalStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MaritalStatus->create();
			if ($this->MaritalStatus->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'marital status'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'marital status'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'marital status'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MaritalStatus->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'marital status'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'marital status'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MaritalStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'marital status'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MaritalStatus->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Marital status'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Marital status'));
		$this->redirect(array('action' => 'index'));
	}
}
?>