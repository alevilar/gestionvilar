<?php
class CountiesController extends AppController {

    var $name = 'Counties';

    function index() {
        $this->County->recursive = 0;
        $this->set('counties', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'county'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('county', $this->County->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->County->create();
            if ($this->County->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'county'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'county'));
            }
        }
        $states = $this->County->State->find('list');
        $this->set(compact('states'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'county'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->County->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'county'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'county'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->County->read(null, $id);
        }
        $states = $this->County->State->find('list');
        $this->set(compact('states'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'county'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->County->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'County'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'County'));
        $this->redirect(array('action' => 'index'));
    }


    function from_state() {

        Configure::write('debug', 0);
        $state_id = 0;
        if (!empty($this->params['url']['state_id'])) {
            $state_id = $this->params['url']['state_id'];
        }
        if (!empty($this->data['City']['state_id'])) {
            $state_id = $this->data['City']['state_id'];
        }
        $cities = $this->County->findFromState($state_id);
        $this->set('counties', $counties);
    }

}
?>