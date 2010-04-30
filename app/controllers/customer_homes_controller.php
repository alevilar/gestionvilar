<?php
class CustomerHomesController extends AppController {

	var $name = 'CustomerHomes';

	function index() {
		$this->CustomerHome->recursive = 0;
		$this->set('customerHomes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer home'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('customerHome', $this->CustomerHome->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CustomerHome->create();
			if ($this->CustomerHome->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer home'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer home'));
			}
		}
		$customers = $this->CustomerHome->Customer->find('list');
		$cities = $this->CustomerHome->City->find('list');
		$this->set(compact('customers', 'cities'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer home'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CustomerHome->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer home'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer home'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CustomerHome->read(null, $id);
		}
		$customers = $this->CustomerHome->Customer->find('list');
		$cities = $this->CustomerHome->City->find('list');
		$this->set(compact('customers', 'cities'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'customer home'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CustomerHome->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Customer home'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Customer home'));
		$this->redirect(array('action' => 'index'));
	}
}
?>