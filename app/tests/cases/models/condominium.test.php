<?php
/* Condominium Test cases generated on: 2010-06-08 16:06:02 : 1276023602*/
App::import('Model', 'Condominium');

class CondominiumTestCase extends CakeTestCase {
	var $fixtures = array('app.condominium', 'app.identification', 'app.identification_type', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.vehicle', 'app.vehicle_type', 'app.f01');

	function startTest() {
		$this->Condominium =& ClassRegistry::init('Condominium');
	}

	function endTest() {
		unset($this->Condominium);
		ClassRegistry::flush();
	}

}
?>