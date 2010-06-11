<?php
/* CharacterTypes Test cases generated on: 2010-06-11 02:06:10 : 1276233070*/
App::import('Controller', 'CharacterTypes');

class TestCharacterTypesController extends CharacterTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CharacterTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.character_type', 'app.character', 'app.identification_type', 'app.identification', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.vehicle', 'app.vehicle_type');

	function startTest() {
		$this->CharacterTypes =& new TestCharacterTypesController();
		$this->CharacterTypes->constructClasses();
	}

	function endTest() {
		unset($this->CharacterTypes);
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