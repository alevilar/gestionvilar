<?php

class SpousesController extends AppController {

    function add($customer_id = null) {
        if (empty($customer_id)) {
            $this->Session->setFlash(__('Invalid Customer ID.', true));
            $this->redirect('/');
        }
        if (!empty($this->data)) {
            $this->Spouse->create();
            if ($this->Spouse->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'Spouse'));
                $this->redirect('/customers/view/'.$customer_id);
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'Spouse'));
            }
        }
        $this->Spouse->CustomerNatural->Customer->id = $customer_id;
        $this->Spouse->CustomerNatural->contain(array('Customer'));
        $customer = $this->Spouse->CustomerNatural->find('first',array(
                'conditions'=> array('CustomerNatural.customer_id'=>$customer_id)));

        if (empty($customer['CustomerNatural'])) {
            $this->Session->setFlash(__('No Customer Natural added yet', true));
            $this->redirect('/');
        }
        if ($customer['Customer']['type'] == 'legal') {
            $this->Session->setFlash(__('Invalid Customer Type', true));
            $this->redirect('/');
        }
        $this->data['Spouse']['customer_natural_id'] = $customer['CustomerNatural']['id'];
        $identificationTypes = $this->Spouse->IdentificationType->find('list');
        $this->set(compact('customer','identificationTypes'));

    }


    function edit($id) {
        if (empty($id)) {
            $this->Session->setFlash(sprintf(__('Invalid %s ID.', true), 'Spouse'));
            $this->redirect('/');
        }
        if (!empty($this->data)) {
            if ($this->Spouse->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'Spouse'));
                $this->Spouse->id = $id;
                $this->data = $this->Spouse->read();
                $this->redirect('/customers/view/'.$this->data['CustomerNatural']['customer_id']);
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'Spouse'));
            }
        }
        $this->Spouse->id = $id;
        $this->data = $this->Spouse->read();
        $identificationTypes = $this->Spouse->IdentificationType->find('list');
        $this->set(compact('identificationTypes'));
    }


    function delete($id) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'cónyuge'));
            $this->redirect('/');
        }
        $this->Spouse->id();
        $this->Spouse->recursive = -1;
        $data = $this->Spouse->read();
        if ($this->Spouse->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'Cónyuge'));
        } else {
            $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Cónyuge'));
        }
        $this->redirect('/customers/view/'.$data['Spouse']['customer_id']);
    }
}

?>
