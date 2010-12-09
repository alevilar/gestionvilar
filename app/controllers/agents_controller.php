<?php
class AgentsController extends AppController {

    var $name = 'Agents';

    function index() {
        $this->Agent->recursive = 0;
        $this->set('agents', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'agent'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('agent', $this->Agent->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Agent->create();
            if ($this->Agent->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'agent'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'agent'));
            }
        }
        $identificationTypes = $this->Agent->IdentificationType->find('list');
        $this->set(compact('identificationTypes'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'agent'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Agent->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'agent'));
                if ($this->RequestHandler->isAjax()) {
                    echo "Guardado !";
                    $this->autoRender = false;
                } else {
                    $this->redirect('/customers/view/'.$this->data['Character']['customer_id']);
                }
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'agent'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Agent->read(null, $id);
        }
         
        $identificationTypes = $this->Agent->IdentificationType->find('list');
        $this->set(compact('identificationTypes'));

        if ($this->RequestHandler->isAjax()) {
             $this->render('edit_ajax');
         }
    }


    

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'agent'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Agent->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'Agent'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Agent'));
        $this->redirect(array('action' => 'index'));
    }
}
?>