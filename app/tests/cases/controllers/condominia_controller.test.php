<?php
/* Condominia Test cases generated on: 2010-06-08 16:06:46 : 1276024306*/
App::import('Controller', 'Condominia');

class TestCondominiaController extends CondominiaController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CondominiaControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.condominium', 'app.identification_type', 'app.identification', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.vehicle', 'app.vehicle_type');

	function startTest() {
		$this->Condominia =& new TestCondominiaController();
		$this->Condominia->constructClasses();
	}

	function endTest() {
		unset($this->Condominia);
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