<?php
class RepresentativesController extends AppController {

	var $name = 'Representatives';

	function index() {
		$this->Representative->recursive = 0;
		$this->set('representatives', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'representative'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('representative', $this->Representative->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Representative->create();
			if ($this->Representative->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'representative'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'representative'));
			}
		}
		$customers = $this->Representative->Customer->find('list');
		$this->set(compact('customers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'representative'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Representative->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'representative'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'representative'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Representative->read(null, $id);
		}
		$customers = $this->Representative->Customer->find('list');
		$this->set(compact('customers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'representative'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Representative->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Representative'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Representative'));
		$this->redirect(array('action' => 'index'));
	}
}
?>