<?php
class CustomersController extends AppController {

	var $name = 'Customers';

	function index() {
		$this->Customer->recursive = 0;
		$this->set('customers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('customer', $this->Customer->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
                    debug($this->data);
			//$this->Customer->create();
			if ($this->Customer->saveAll($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer'));
			}
		}

                $maritalStatuses = $this->Customer->CustomerType->MaritalStatus->find('list');
		$this->set(compact('maritalStatuses'));
                
                $idenficationTypes = $this->Customer->Identification->IdentificationType->find('list');
		$this->set(compact('idenficationTypes'));

                $customers = $this->Customer->CustomerHome->Customer->find('list');
		$cities = $this->Customer->CustomerHome->City->find('list');
                $counties = $this->Customer->CustomerHome->City->County->find('list');
                $states = $this->Customer->CustomerHome->City->County->State->find('list');
		$this->set(compact('customers', 'cities', 'counties', 'states'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Customer->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Customer->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'customer'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Customer->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Customer'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Customer'));
		$this->redirect(array('action' => 'index'));
	}


        function search(){
            if (!empty($this->data)) {
		$this->set('customers', $this->paginate());
            }
            
        }
}
?>