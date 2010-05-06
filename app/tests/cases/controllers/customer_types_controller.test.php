<?php
/* CustomerTypes Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'CustomerTypes');

class TestCustomerTypesController extends CustomerTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CustomerTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer_type', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle', 'app.marital_status');

	function startTest() {
		$this->CustomerTypes =& new TestCustomerTypesController();
		$this->CustomerTypes->constructClasses();
	}

	function endTest() {
		unset($this->CustomerTypes);
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