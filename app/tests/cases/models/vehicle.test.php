<?php
/* Vehicle Test cases generated on: 2010-04-28 19:04:46 : 1272493606*/
App::import('Model', 'Vehicle');

class VehicleTestCase extends CakeTestCase {
	var $fixtures = array('app.vehicle', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative');

	function startTest() {
		$this->Vehicle =& ClassRegistry::init('Vehicle');
	}

	function endTest() {
		unset($this->Vehicle);
		ClassRegistry::flush();
	}

}
?>