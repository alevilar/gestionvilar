<?php
class VehiclesController extends AppController {

	var $name = 'Vehicles';

        var $paginate = array('limit' => 30);

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
                if(!empty($fv)) {
                    $formTal =& ClassRegistry::init($fv);
                    $dataform = $formTal->find('all', array(
                                        'order' => array('created desc'),
                                        'recursive' => -1,
                                        'fields'    =>array('id','created'),
                                        'conditions'=> array('vehicle_id'=>$vehicle_id)));
                    $vehicleForms[$fv] = $dataform;
                }
            }


            $this->set('vehicle',$this->Vehicle->read(null, $vehicle_id));
            $this->set('vehicleForms',$vehicleForms);
            $this->set('printer', ClassRegistry::init('Printer')->find('first',array('order'=>'id')));

        }

        function customer($customer_id) {

                $this->passedArgs['Customer.id'] = $customer_id;

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
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), __('vehicle',true)).".<br> Con el N° de Chasis: ".$this->data['Vehicle']['chasis_number']);
                                if (!$continue_adding) {
                                    $this->redirect(array('controller'=>'customers','action' => 'search'));
                                }
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true),  __('vehicle',true)));
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
				$this->Session->setFlash(sprintf(__('The %s has been saved', true),  __('vehicle',true)));
				$this->redirect('/');
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true),  __('vehicle',true)));
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
            $conditions = $conditionsCustomer = $conditionsVehicle = array();
            if ( empty($this->data) && empty($this->passedArgs)) {
                $cName = $this->Session->read('Customer.name');
                if ( !empty($cName) ) {
                    $conditionsCustomer['Customer.name LIKE'] = "%" . $cName . "%";
                    $this->passedArgs['Customer.name'] = $cName;
                }
                $cId = $this->Session->read('Customer.id');
                if (!empty($cId)) {
                    $conditionsCustomer['Customer.id'] = $cId;
                     $this->passedArgs['Customer.id'] = $cId;
                }
                $vPatente = $this->Session->read('Vehicle.patente');
                if (!empty($vPatente)) {
                    $conditionsVehicle['Vehicle.patente LIKE'] = "%" . $vPatente . "%";
                    $this->passedArgs['Vehicle.patente'] = $vPatente;
                }
                $vChasisN = $this->Session->read('Vehicle.chasis_number');
                if (!empty($vChasisN)) {
                    $conditionsVehicle['Vehicle.chasis_number LIKE'] = "%" . $vChasisN . "%";
                    $this->passedArgs['Vehicle.chasis_number'] = $vChasisN;
                }
                $vMotorN = $this->Session->read('Vehicle.motor_number');
                if (!empty($vMotorN)) {
                    $conditionsVehicle['Vehicle.motor_number LIKE'] = "%" . $vMotorN . "%";
                    $this->passedArgs['Vehicle.motor_number'] = $vMotorN;
                }
            }

            if (!empty($this->data['Customer']['name'])) {
                $conditionsCustomer['Customer.name LIKE'] = "%" . $this->data['Customer']['name'] . "%";
                 $this->passedArgs['Customer.name'] = $this->data['Customer']['name'];
            }
            if (!empty($this->data['Customer']['id'])) {
                $conditionsCustomer['Customer.id'] = $this->data['Customer']['id'];
                 $this->passedArgs['Customer.id'] = $this->data['Customer']['id'];
            }
            if (!empty($this->data['Vehicle']['patente'])) {
                $conditionsVehicle['Vehicle.patente LIKE'] = "%" . $this->data['Vehicle']['patente'] . "%";
                $this->passedArgs['Vehicle.patente'] = $this->data['Vehicle']['patente'];
            }
            if (!empty($this->data['Vehicle']['chasis_number'])) {
                $conditionsVehicle['Vehicle.chasis_number LIKE'] = "%" . $this->data['Vehicle']['chasis_number'] . "%";
                $this->passedArgs['Vehicle.chasis_number'] = $this->data['Vehicle']['chasis_number'];
            }
            if (!empty($this->data['Vehicle']['motor_number'])) {
                $conditionsVehicle['Vehicle.motor_number LIKE'] = "%" . $this->data['Vehicle']['motor_number'] . "%";
                $this->passedArgs['Vehicle.motor_number'] = $this->data['Vehicle']['motor_number'];
            }


            if (!empty($this->passedArgs['Customer.name'])) {
                $conditionsCustomer['Customer.name LIKE'] = "%" . $this->passedArgs['Customer.name'] . "%";
                $this->Session->write('Customer.name', $this->passedArgs['Customer.name']);
            }
            if (!empty($this->passedArgs['Vehicle.patente'])) {
                $conditionsVehicle['Vehicle.patente LIKE'] = "%" . $this->passedArgs['Vehicle.patente'] . "%";
                $this->Session->write('Vehicle.patente', $this->passedArgs['Vehicle.patente']);
            }
            if (!empty($this->passedArgs['Vehicle.chasis_number'])) {
                $conditionsVehicle['Vehicle.chasis_number LIKE'] = "%" . $this->passedArgs['Vehicle.chasis_number'] . "%";
                $this->Session->write('Vehicle.chasis_number', $this->passedArgs['Vehicle.chasis_number']);
            }
            if (!empty($this->passedArgs['Vehicle.motor_number'])) {
                $conditionsVehicle['Vehicle.motor_number LIKE'] = "%" . $this->passedArgs['Vehicle.motor_number'] . "%";
                $this->Session->write('Vehicle.motor_number', $this->passedArgs['Vehicle.motor_number']);
            }
            if (!empty($this->passedArgs['Customer.id'])) {
                $conditionsCustomer['Customer.id'] = $this->passedArgs['Customer.id'];
                $this->Session->write('Customer.id', $this->passedArgs['Customer.id']);
                $customer = $this->Vehicle->Customer->read(null, $this->passedArgs['Customer.id']);
                $this->set('customer', $customer['Customer']);
            }
            
            $conditions = array_merge($conditionsCustomer, $conditionsVehicle);
            
           // if ( empty($conditions) && empty($this->passedArgs) )  $this->redirect('/customers/search');

            
            $this->paginate['Customer'] = array(
                'joins' => array(
                    array(
                       'table'=>'vehicles',
                       'alias'=>'Vehicle',
                       'type' =>'LEFT',
                       'conditions' => array('Customer.id = Vehicle.customer_id'),
                     ),
                    array(
                       'table'=>'vehicle_types',
                       'alias'=>'VehicleType',
                       'type' =>'LEFT',
                       'conditions' =>array('VehicleType.id = Vehicle.vehicle_type_id'),
                     ),
                ),
                'contain'=>array('Vehicle.VehicleType'),
                'conditions'=>$conditionsCustomer+$conditionsVehicle,
                'group' => 'Customer.id',
                'order' => 'Customer.name',
            );
            $customers = $this->paginate('Customer');
            $cant = count($this->Vehicle->Customer->find('list', $this->paginate['Customer']));
            //debug( $this->params['paging']);
            $this->params['paging']['Customer']['count'] = $cant;
            $limit = empty($this->paginate['limit']) ? 20 : $this->paginate['limit'];
            $pageCount = round($cant/$limit)+1;
            $this->params['paging']['Customer']['pageCount'] = $pageCount;

            
            $this->paginate['Vehicle'] = array(
                'contain'=>array('VehicleType','Customer'),
                'conditions'=>$conditionsCustomer+$conditionsVehicle,
            );
            $vehicles = $this->paginate('Vehicle');
            
            $this->set('vehicles', $vehicles);
            $this->set('customers', $customers);

            if ( !empty($this->passedArgs['redirect']) ) {
                switch ($this->passedArgs['redirect']) {
                    case 'VehicleIndex':
                        $this->render('ajax/index');
                        break;
                    case 'CustomerIndex':
                        $this->render('/customers/ajax/index');
                    default:
                        break;
                }
            }               
        }
}
?>