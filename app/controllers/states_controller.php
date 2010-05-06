<?php
class StatesController extends AppController {

	var $name = 'States';

	function index() {
		$this->State->recursive = 0;
		$this->set('states', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'state'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('state', $this->State->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->State->create();
			if ($this->State->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'state'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'state'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'state'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->State->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'state'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'state'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->State->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'state'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->State->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'State'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'State'));
		$this->redirect(array('action' => 'index'));
	}
}
?>