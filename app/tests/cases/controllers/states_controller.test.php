<?php
/* States Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'States');

class TestStatesController extends StatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.state', 'app.county', 'app.city', 'app.customer_home', 'app.customer', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->States =& new TestStatesController();
		$this->States->constructClasses();
	}

	function endTest() {
		unset($this->States);
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