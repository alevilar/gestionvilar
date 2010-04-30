<?php
/* MaritalStatuses Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'MaritalStatuses');

class TestMaritalStatusesController extends MaritalStatusesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MaritalStatusesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.marital_status', 'app.customer_type', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->MaritalStatuses =& new TestMaritalStatusesController();
		$this->MaritalStatuses->constructClasses();
	}

	function endTest() {
		unset($this->MaritalStatuses);
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