<?php
/* F04 Test cases generated on: 2010-06-12 20:06:49 : 1276387009*/
App::import('Model', 'F04');

class F04TestCase extends CakeTestCase {
	var $fixtures = array('app.f04', 'app.vehicle', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.identification_type', 'app.identification', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle_type');

	function startTest() {
		$this->F04 =& ClassRegistry::init('F04');
	}

	function endTest() {
		unset($this->F04);
		ClassRegistry::flush();
	}

}
?>