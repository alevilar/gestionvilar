<?php
class CondominiaController extends AppController {

	var $name = 'Condominia';

	function index() {
		$this->Condominium->recursive = 0;
		$this->set('condominia', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'condominium'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('condominium', $this->Condominium->read(null, $id));
	}

	function add($customer_id = null) {
            if (empty($customer_id)){
                $this->Session->setFlash("Error en el ID del cliente pasado como parámetro");
                $this->redirect('/');
            }
		if (!empty($this->data)) {
			$this->Condominium->create();
			if ($this->Condominium->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'condominium'));
				$this->redirect('/customers/view/'.$customer_id);
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'condominium'));
			}
		}

                
                $this->data['Condominium']['customer_id'] = $customer_id;
		$identificationTypes = $this->Condominium->IdentificationType->find('list');
		$maritalStatuses = $this->Condominium->MaritalStatus->find('list');
		$customers = $this->Condominium->Customer->find('list');
                $nationalityTypes = $this->Condominium->nationalityTypes;
                $customer = $this->Condominium->Customer->read(null, $customer_id);
		$this->set(compact('identificationTypes', 'maritalStatuses', 'customers', 'customer','nationalityTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'condominium'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Condominium->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'condominium'));
				$this->redirect('/customers/view/'.$this->data['Condominium']['customer_id']);
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'condominium'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Condominium->read(null, $id);
		}
		$identificationTypes = $this->Condominium->IdentificationType->find('list');
		$maritalStatuses = $this->Condominium->MaritalStatus->find('list');
		$customers = $this->Condominium->Customer->find('list');
                $nationalityTypes = $this->Condominium->nationalityTypes;
                $customer = $this->Condominium->Customer->read(null, $this->data['Condominium']['customer_id']);
		$this->set(compact('identificationTypes', 'maritalStatuses', 'customers','customer','nationalityTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'condominium'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Condominium->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Condominium'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Condominium'));
		$this->redirect(array('action' => 'index'));
	}
}
?>