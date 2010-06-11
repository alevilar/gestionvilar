<?php
class CharacterTypesController extends AppController {

	var $name = 'CharacterTypes';

	function index() {
		$this->CharacterType->recursive = 0;
		$this->set('characterTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'character type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('characterType', $this->CharacterType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CharacterType->create();
			if ($this->CharacterType->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'character type'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'character type'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'character type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CharacterType->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'character type'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'character type'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CharacterType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'character type'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CharacterType->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Character type'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Character type'));
		$this->redirect(array('action' => 'index'));
	}
}
?>