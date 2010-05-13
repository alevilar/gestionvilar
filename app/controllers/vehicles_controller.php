<?php
class VehiclesController extends AppController {

	var $name = 'Vehicles';

	function index() {
		$this->Vehicle->recursive = 0;
		$this->set('vehicles', $this->paginate());
	}

        function customer($customer_id) {
		$this->Vehicle->recursive = 0;
                $this->paginate['Vehicle'] = array(
                    'conditions' => array('Vehicle.customer_id'=>$customer_id),
                    'contain' => array('Customer', 'VehicleType'),
                        );
		$this->set('vehicles', $this->paginate('Vehicle'));
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

	function add($customer_id = null) {
                if (empty($customer_id)) {
                    if (!empty($this->data['Vehicle']['customer_id'])){
                        $customer_id = $this->data['Vehicle']['customer_id'];
                    }
                }
		if (!empty($this->data)) {
			$this->Vehicle->create();
			if ($this->Vehicle->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'vehicle'));
				$this->redirect(array('controller'=>'customers','action' => 'search'));
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
		$this->set(compact('customers', 'vehicle_types'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'vehicle'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Vehicle->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'vehicle'));
				$this->redirect(array('action' => 'index'));
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
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'vehicle'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Vehicle->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Vehicle'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Vehicle'));
		$this->redirect(array('action' => 'index'));
	}
}
?>