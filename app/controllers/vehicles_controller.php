<?php
class VehiclesController extends AppController {

	var $name = 'Vehicles';

	function index() {
                $this->paginate = array(
                    'contain'=> array('VehicleType'),
                );
		$this->set('vehicles', $this->paginate());
	}

        function index_forms($vehicle_id){
            $fieldCreator =& ClassRegistry::init('FieldCreator');
            $forms = $fieldCreator->find('list', array('fields'=>array('id','model'),'conditions'=>array('activo'=>1)));
            
            $vehicleForms = array();
            foreach ($forms as $fID=>$fv ){
                $formTal =& ClassRegistry::init($fv);
                $dataform = $formTal->find('all', array(
                                    'order' => array('created desc'),
                                    'recursive' => -1,
                                    'fields'    =>array('id','created'),
                                    'conditions'=> array('vehicle_id'=>$vehicle_id)));
                $vehicleForms[$fv] = $dataform;
            }


            $this->set('vehicle',$this->Vehicle->read(null, $vehicle_id));
            $this->set('vehicleForms',$vehicleForms);
            $this->set('printer', ClassRegistry::init('Printer')->find('first',array('order'=>'id')));

        }

        function customer($customer_id) {
		$this->Vehicle->recursive = 0;
                $this->paginate['Vehicle'] = array(
                    'conditions' => array('Vehicle.customer_id'=>$customer_id),
                    'contain' => array('Customer', 'VehicleType'),
                        );
		$this->set('vehicles', $this->paginate('Vehicle'));
                $this->Vehicle->Customer->recursive = -1;
                $this->Vehicle->Customer->id = $customer_id;
                $this->set('customer', $this->Vehicle->Customer->read());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'vehicle'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('vehicle', $this->Vehicle->read(null, $id));
	}

	function add($customer_id = null, $continue_adding = true) {
                if (empty($customer_id)) {
                    if (!empty($this->data['Vehicle']['customer_id'])){
                        $customer_id = $this->data['Vehicle']['customer_id'];
                    }
                }
                $this->Vehicle->Customer->id = $customer_id;
                $this->Vehicle->Customer->recursive = -1;
                $customer = $this->Vehicle->Customer->read();
                
		if (!empty($this->data)) {
			$this->Vehicle->create();
			if ($this->Vehicle->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'vehicle'));
                                if (!$continue_adding) {
                                    $this->redirect(array('controller'=>'customers','action' => 'search'));
                                }
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'vehicle'));
			}
		} else {
                    if (!empty($customer_id)){
                        $this->data['Vehicle']['customer_id'] = $customer_id;
                    }
                }
                $vehicle_types = $this->Vehicle->VehicleType->find('list');
		$customers = $this->Vehicle->Customer->find('list');
		$this->set(compact('customers', 'vehicle_types','customer'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'vehicle'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Vehicle->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'vehicle'));
				$this->redirect('/');
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'vehicle'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Vehicle->read(null, $id);
		}
		$vehicle_types = $this->Vehicle->VehicleType->find('list');
		$customers = $this->Vehicle->Customer->find('list');
		$this->set(compact('customers', 'vehicle_types'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), __('vehicle',true)));
			$this->redirect('/');
		}
		if ($this->Vehicle->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), __('Vehicle',true) ));
			$this->redirect('/');
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), __('Vehicle',true) ));
	}


        function search($customer_id = 0) {
            $conditions = array();
            if (!empty($this->data['Customer']['name'])) {
                $add = array( 'Customer.name LIKE' =>"%" . $this->data['Customer']['name'] . "%");
                $conditions = array_merge($conditions, $add);
            }
            if (!empty($this->data['Vehicle']['patente'])) {
                $add = array( 'Vehicle.patente LIKE'=> "%" . $this->data['Vehicle']['patente'] . "%");
                $conditions = array_merge($conditions, $add);
            }
            if (!empty($this->data['Vehicle']['chasis_number'])) {
                $add = array( 'Vehicle.chasis_number LIKE'=>"%" . $this->data['Vehicle']['chasis_number'] . "%");
                $conditions = array_merge($conditions, $add);
            }

            $this->paginate['Vehicle'] = array(
                'contain'=>array('Customer', 'VehicleType'),
                'conditions'=>$conditions,
            );
            $vehicles = $this->paginate('Vehicle');

            $this->paginate['Vehicle'] = array(
                'contain'=>array('Customer', 'VehicleType'),
                'conditions'=>$conditions,
                'group' => 'Customer.id',
            );
            $vehiclesForCustomer = $this->paginate('Vehicle');
            $customers = array();
            foreach ($vehiclesForCustomer as $v) {
                $customers[] = $v;
            }

            $this->set('vehicles', $vehicles);
            $this->set('customers', $customers);
        }
}
?>