<?php
/* IdentificationTypes Test cases generated on: 2010-04-29 15:04:56 : 1272566276*/
App::import('Controller', 'IdentificationTypes');

class TestIdentificationTypesController extends IdentificationTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IdentificationTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.identification_type', 'app.identification');

	function startTest() {
		$this->IdentificationTypes =& new TestIdentificationTypesController();
		$this->IdentificationTypes->constructClasses();
	}

	function endTest() {
		unset($this->IdentificationTypes);
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