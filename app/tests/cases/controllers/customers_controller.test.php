<?php
/* Customers Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'Customers');

class TestCustomersController extends CustomersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CustomersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->Customers =& new TestCustomersController();
		$this->Customers->constructClasses();
	}

	function endTest() {
		unset($this->Customers);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>