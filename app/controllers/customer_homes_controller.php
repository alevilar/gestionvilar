<?php
class CustomerHomesController extends AppController {

	var $name = 'CustomerHomes';

        var $types = array(
            'Legal' => 'Legal',
            'Fiscal' => 'Fiscal',
            'Guarda Habitual' => 'Guarda Habitual',
            'Postal' => 'Postal',
            'Real' => 'Real',
        );

	function index() {
		$this->CustomerHome->recursive = 0;
		$this->set('customerHomes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer home'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('customerHome', $this->CustomerHome->read(null, $id));
	}

	function add($customer_id) {

		if (!empty($this->data)) {
			$this->CustomerHome->create();
			if ($this->CustomerHome->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer home'));
				$this->redirect(array('controller'=>'customers','action' => 'view',$this->data['CustomerHome']['customer_id']));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer home'));
			}
		}
                $this->data['CustomerHome']['customer_id'] = $customer_id;
                $this->set('types', $this->types);
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'customer home'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CustomerHome->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'customer home'));
				$this->redirect(array('controller'=>'customers','action' => 'view',$this->data['CustomerHome']['customer_id']));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'customer home'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CustomerHome->read(null, $id);
		}
                
		$this->set('types', $this->types);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'customer home'));
			$this->redirect($this->referer());
		}
		if ($this->CustomerHome->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Customer home'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Customer home'));
		$this->redirect($this->referer());
	}
}
?>