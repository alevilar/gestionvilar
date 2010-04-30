<?php
/* Representatives Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'Representatives');

class TestRepresentativesController extends RepresentativesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RepresentativesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.representative', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.vehicle');

	function startTest() {
		$this->Representatives =& new TestRepresentativesController();
		$this->Representatives->constructClasses();
	}

	function endTest() {
		unset($this->Representatives);
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