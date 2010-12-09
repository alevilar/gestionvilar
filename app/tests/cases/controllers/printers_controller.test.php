<?php
/* Printers Test cases generated on: 2010-07-05 01:07:20 : 1278303380*/
App::import('Controller', 'Printers');

class TestPrintersController extends PrintersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PrintersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.printer');

	function startTest() {
		$this->Printers =& new TestPrintersController();
		$this->Printers->constructClasses();
	}

	function endTest() {
		unset($this->Printers);
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