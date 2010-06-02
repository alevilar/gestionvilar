<?php
class CustomersController extends AppController {

    var $name = 'Customers';

    function index() {
        $this->paginate['Customer'] = array(
                'limit'=>10,
                'contain'=> array(
                        'Identification' => array('IdentificationType'),
                        'CustomerLegal',
                        'CustomerNatural',
                        'CustomerHome',
                        'Representative',
                )
        );
        $cus = $this->paginate('Customer');
        foreach ($cus as &$c) {
            $c['Customer']['type'] = $this->Customer->types[$c['Customer']['type']];
        }
        $this->set('customers', $cus);
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Customer->contain(array(
            'CustomerHome','CustomerLegal',
            'Identification'=> array('IdentificationType'),
            'CustomerNatural'=>array(
                'MaritalStatus',
                'Spouse'=>array('IdentificationType'),
                ),
            'Representative'=>array('IdentificationType'),
        ));
        $this->set('customer', $this->Customer->read(null, $id));
        $this->set('nationalities', $this->Customer->Representative->nationalityTypes);
    }

    function edit($id = null) {
        if (!empty($this->data)) {
            //$this->Customer->create();
            $retorno_save = $this->Customer->saveAllAboutCustomer($this->data);
            switch ($retorno_save) {
                case -1:
                    $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer'));
                    debug($this->Customer->validationErrors);
                    break;
                case -21:
                    $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'persona física'));
                    debug($this->Customer->CustomerNatural->validationErrors);
                    // $this->redirect("/customers/edit/".$this->Customer->id);
                    break;
                case -22:
                    $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'persona jurídica'));
                    debug($this->Customer->CustomerLegal->validationErrors);
                    //$this->redirect("/customers/edit/".$this->Customer->id);
                    break;
                case -3:
                    $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identificación del cliente'));
                    debug($this->Customer->Identification->validationErrors);
                    //$this->redirect("/customers/edit/".$this->Customer->id);
                    break;
                case -4:
                    $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'dirección del cliente'));
                    debug($this->Customer->CustomerHome->validationErrors);
                    //$this->redirect("/customers/edit/".$this->Customer->id);
                    break;
                case 1:
                    $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'cliente'));
                    $this->redirect('/customers/view/'.$this->Customer->id);
                    break;
                default:
                    $this->Session->setFlash(sprintf(__('Error saving the customer', true), 'customer'));
                    break;
            }
            $this->data = $this->Customer->data;
        } else {
            if (!empty($id)) {
                $this->Customer->id = $id;
                $this->Customer->contain(array(
                        'CustomerNatural',
                        'CustomerLegal',
                        'CustomerHome'=>array(
                                'City'=>array('County'),
                        ),
                        'Identification',
                ));
                $this->data = $this->Customer->read();

                if (!empty($this->data['CustomerHome']['City'])) {
                    $this->data['CustomerHome']['state_id']  = $this->data['CustomerHome']['City']['County']['state_id'];
                    $this->data['CustomerHome']['county_id'] = $this->data['CustomerHome']['City']['County']['id'];
                }
            }
        }

        $maritalStatuses = $this->Customer->CustomerNatural->MaritalStatus->find('list');
        $identificationTypes = $this->Customer->Identification->IdentificationType->find('list');
        $nationalityTypes = $this->Customer->CustomerNatural->nationalityTypes;
        //$cities =$this->Customer->CustomerHome->City->find('list');
        //$counties = $this->Customer->CustomerHome->City->County->find('list');
        //$states = $this->Customer->CustomerHome->City->County->State->find('list');
        $types = $this->Customer->types;
        $this->set(compact(
                'types', 'identificationTypes', 'maritalStatuses', 'nationalityTypes'));
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


    function clist() {
        $conditions = array();
        die("putasa");

        $this->paginate['Customer'] = array(
                'limit'=>10,
                'contain'=> array('Vehicle'=>array('VehicleType')),
                'conditions'=> $conditions,
        );
        $this->set('customers', $this->paginate('Customer'));
    }


    function search() {
        $conditions = array();

        $pageCustomer = 1;
        $pageVehicle  = 1;

        if (!empty($this->passedArgs['pagModel'])) {
            if ($this->passedArgs['pagModel'] == 'Customer') {
                $pageVehicle = 1;
            }
            else {
                $pageCustomer = 1;
            }
        }

        $this->paginate['Customer'] = array(
                'limit'=>10,
                'contain'=> array('Vehicle'=>array('VehicleType')),
                'conditions'=> $conditions,
                'page'=> $pageCustomer,
        );
        $this->set('customers', $this->paginate('Customer'));

        $this->paginate['Vehicle'] = array(
                'limit'=>10,
                'contain'=> array('VehicleType','Customer'),
                'conditions'=> $conditions,
                'page'=> $pageVehicle,
        );
        $this->set('vehicles', $this->paginate('Vehicle'));
        
    }
}


?>