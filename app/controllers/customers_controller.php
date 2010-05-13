<?php
class CustomersController extends AppController {

	var $name = 'Customers';

	function index() {
                $this->paginate['Customer'] = array(
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
		$this->set('customer', $this->Customer->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			//$this->Customer->create();
                        $retorno_save = $this->Customer->saveAllAboutCustomer($this->data);
			switch ($retorno_save) {
                            case -1:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer'));
                                break;
                            case -21:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'persona física'));
                                $this->redirect("/customers/edit/".$this->Customer->id);
                                break;
                            case -22:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'persona jurídica'));
                                $this->redirect("/customers/edit/".$this->Customer->id);
                                break;
                            case -3:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identificación del cliente'));
                                debug($this->Customer->Identification->validationErrors);
                                $this->redirect("/customers/edit/".$this->Customer->id);
                                break;
                            case -4:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'dirección del cliente'));
                                $this->redirect("/customers/edit/".$this->Customer->id);
                            break;
                            case 1:
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'cliente'));
				$this->redirect('/');
                                break;
                            default:
				$this->Session->setFlash(sprintf(__('Error saving the customer', true), 'customer'));
                            break;
			}
		}
                $maritalStatuses = $this->Customer->CustomerNatural->MaritalStatus->find('list');
                $identificationTypes = $this->Customer->Identification->IdentificationType->find('list');
                $customers = $this->Customer->CustomerHome->Customer->find('list');
		$cities = $this->Customer->CustomerHome->City->find('list');
                $counties = $this->Customer->CustomerHome->City->County->find('list');
                $states = $this->Customer->CustomerHome->City->County->State->find('list');
                $types = $this->Customer->types;
		$this->set(compact('types','customers', 'cities', 'counties', 'states', 'identificationTypes', 'maritalStatuses'));
	}

	function edit($id = null) {
		if (!empty($this->data)) {
			//$this->Customer->create();
                        $retorno_save = $this->Customer->saveAllAboutCustomer($this->data);
			switch ($retorno_save) {
                            case -1:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'cliente'));
                                break;
                            case -21:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'persona física'));
                                $this->redirect("/customers/edit/".$this->Customer->id);
                                break;
                            case -22:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'persona jurídica'));
                                $this->redirect("/customers/edit/".$this->Customer->id);
                                break;
                            case -3:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'identificación del cliente'));
                            debug($this->Customer->Identification->validationErrors);die();
                            $this->redirect("/customers/edit/".$this->Customer->id);
                                break;
                            case -4:
                                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'dirección del cliente'));
                                $this->redirect("/customers/edit/".$this->Customer->id);
                            break;
                            case 1:
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'cliente'));
				$this->redirect('/');
                                break;
                            default:
				$this->Session->setFlash(sprintf(__('Error saving the customer', true), 'cliente'));
			}
		} else {
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
                $maritalStatuses = $this->Customer->CustomerNatural->MaritalStatus->find('list');
                $identificationTypes = $this->Customer->Identification->IdentificationType->find('list');
                $cities =$this->Customer->CustomerHome->City->find('list');
                $counties = $this->Customer->CustomerHome->City->County->find('list');
                $states = $this->Customer->CustomerHome->City->County->State->find('list');
                $types = $this->Customer->types;
		$this->set(compact(
                        'types', 'cities', 'counties',
                        'states', 'identificationTypes', 'maritalStatuses'));
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


        function search() {
            $conditions = array();
            if (!empty($this->data['Vehicle']['patente'])) {
                $conditions = array_merge($conditions, array('Vehicle.patente'=>$this->data['Vehicle']['patente']));
            }
            if (!empty($this->data['Vehicle']['chasis_number'])) {
                $conditions = array_merge($conditions, array('Vehicle.chasis_number'=>$this->data['Vehicle']['chasis_number']));
            }
            if (!empty($this->data['Customer']['name'])) {
                $conditions = array_merge($conditions, array('Customer.name'=>$this->data['Customer']['name']));
            }
            $this->paginate['Customer'] = array(
                'contain'=> array('Vehicle'=>array('VehicleType')),
                'conditions'=> $conditions,
            );
            $this->set('customers', $this->paginate('Customer'));

            $this->paginate['Vehicle'] = array(
                'contain'=> array('VehicleType','Customer'),
                'conditions'=> $conditions,
            );
            $this->set('vehicles', $this->paginate('Vehicle'));
        }
}
?>