<?php
/* CustomerHomes Test cases generated on: 2010-04-28 19:04:28 : 1272495508*/
App::import('Controller', 'CustomerHomes');

class TestCustomerHomesController extends CustomerHomesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CustomerHomesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer_home', 'app.customer', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle', 'app.city', 'app.county', 'app.state');

	function startTest() {
		$this->CustomerHomes =& new TestCustomerHomesController();
		$this->CustomerHomes->constructClasses();
	}

	function endTest() {
		unset($this->CustomerHomes);
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