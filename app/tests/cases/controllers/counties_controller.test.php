<?php
/* Counties Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'Counties');

class TestCountiesController extends CountiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CountiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.county', 'app.state', 'app.city', 'app.customer_home', 'app.customer', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->Counties =& new TestCountiesController();
		$this->Counties->constructClasses();
	}

	function endTest() {
		unset($this->Counties);
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