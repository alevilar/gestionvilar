<?php
/* Identifications Test cases generated on: 2010-04-29 15:04:10 : 1272566350*/
App::import('Controller', 'Identifications');

class TestIdentificationsController extends IdentificationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IdentificationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.identification', 'app.identification_type', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->Identifications =& new TestIdentificationsController();
		$this->Identifications->constructClasses();
	}

	function endTest() {
		unset($this->Identifications);
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