<?php
/* Vehicles Test cases generated on: 2010-04-28 19:04:15 : 1272493695*/
App::import('Controller', 'Vehicles');

class TestVehiclesController extends VehiclesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VehiclesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.vehicle', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative');

	function startTest() {
		$this->Vehicles =& new TestVehiclesController();
		$this->Vehicles->constructClasses();
	}

	function endTest() {
		unset($this->Vehicles);
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