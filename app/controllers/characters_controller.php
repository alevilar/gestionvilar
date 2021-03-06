<?php
class CharactersController extends AppController {

    var $name = 'Characters';

    function index() {
        $this->Character->recursive = 0;
        $this->set('characters', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'character'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('character', $this->Character->read(null, $id));
    }


    function add($customer_id = null) {
        
        if (!empty($this->data)) {
            $this->Character->create();
            if ($this->Character->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), __('Character', true)));
                if (empty($customer_id)){
                    $this->redirect('/characters/index');

                } else {
                    $this->redirect('/customers/view/'.$customer_id);
                }
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('Character', true)));
            }
        }

        $customer = array();
        if (!empty($customer_id)) {
            $this->data['Character']['customer_id'] = $customer_id;
            $customer = $this->Character->Customer->read(null, $customer_id);
        }
        
        $identificationTypes = $this->Character->IdentificationType->find('list');
        $maritalStatuses = $this->Character->MaritalStatus->find('list');
        $customers = $this->Character->Customer->find('list');
        $characterTypes = $this->Character->CharacterType->find('list');
        $nationalityTypes = $this->Character->nationalityTypes;        
        $this->set(compact('identificationTypes', 'maritalStatuses', 'customers', 'customer','nationalityTypes', 'characterTypes'));
    }

    function edit($id = null) {
        
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'character'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Character->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), __('Character', true)));
                if ($this->RequestHandler->isAjax()){
                    echo "Guardado !";
                    $this->autoRender = false;
                } else {
                    $this->redirect('/customers/view/'.$this->data['Character']['customer_id']);
                }
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('Character', true)));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Character->read(null, $id);
        }
        $characterTypes = $this->Character->CharacterType->find('list');
        $identificationTypes = $this->Character->IdentificationType->find('list');
        $maritalStatuses = $this->Character->MaritalStatus->find('list');
        $customers = $this->Character->Customer->find('list');
        $nationalityTypes = $this->Character->nationalityTypes;
        $customer = $this->Character->Customer->read(null, $this->data['Character']['customer_id']);
        $this->set(compact('identificationTypes', 'maritalStatuses', 'customers','customer','nationalityTypes', 'characterTypes'));
        $this->render('add');
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'character'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Character->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'Character'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Character'));
        $this->redirect(array('action' => 'index'));
    }
}
?>