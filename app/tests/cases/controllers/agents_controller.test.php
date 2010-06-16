<?php
/* Agents Test cases generated on: 2010-06-12 20:06:29 : 1276387169*/
App::import('Controller', 'Agents');

class TestAgentsController extends AgentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AgentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.agent', 'app.identification_type', 'app.identification', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle', 'app.vehicle_type');

	function startTest() {
		$this->Agents =& new TestAgentsController();
		$this->Agents->constructClasses();
	}

	function endTest() {
		unset($this->Agents);
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