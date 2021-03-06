<?php
class PrintersController extends AppController {

	var $name = 'Printers';

	function index() {
		$this->Printer->recursive = 0;
		$this->set('printers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'printer'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('printer', $this->Printer->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Printer->create();
			if ($this->Printer->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'printer'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'printer'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'printer'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Printer->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'printer'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'printer'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Printer->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'printer'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Printer->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Printer'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Printer'));
		$this->redirect(array('action' => 'index'));
	}
}
?>