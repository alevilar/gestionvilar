<?php
/* Identification Test cases generated on: 2010-04-29 15:04:55 : 1272566335*/
App::import('Model', 'Identification');

class IdentificationTestCase extends CakeTestCase {
	var $fixtures = array('app.identification', 'app.identification_type', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->Identification =& ClassRegistry::init('Identification');
	}

	function endTest() {
		unset($this->Identification);
		ClassRegistry::flush();
	}

}
?>