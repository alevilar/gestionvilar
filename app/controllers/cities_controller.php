<?php
class CitiesController extends AppController {

    var $name = 'Cities';

    function index() {
        $this->City->recursive = 0;
        $this->set('cities', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'city'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('city', $this->City->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->City->create();
            if ($this->City->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'city'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'city'));
            }
        }
        $counties = $this->City->County->find('list');
        $this->set(compact('counties'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'city'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->City->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'city'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'city'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->City->read(null, $id);
        }
        $counties = $this->City->County->find('list');
        $this->set(compact('counties'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'city'));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->City->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'City'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'City'));
        $this->redirect(array('action' => 'index'));
    }


    function withCountyAndState() {
        $conditions = array();
        if (!empty($this->data['City']['name'])) {
            $conditions[] = array('City.name LIKE'=> '%' . $this->data['City']['name'] . '%');
        }
        $cities = $this->City->getWithCountyAndState($conditions);
        $this->layout = false;
        $this->autoRender= false;
        return json_encode($cities);
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
        $cities = $this->City->findFromState($state_id);
        $this->set('cities', $cities);
        $this->render('default');
    }




    function from_county() {

        Configure::write('debug', 0);
        $county_id = 0;
        if (!empty($this->passedArgs['county_id'])) {
            $county_id = $this->passedArgs['county_id'];
        }
        if (!empty($this->data['City']['county_id'])) {
            $county_id = $this->data['City']['county_id'];
        }
        $cities = $this->City->findFromCounty($county_id);
        $this->render('select_list', 'ajax');
        $this->set('cities', $cities);
    }

}
?>