<?php
/* F08 Test cases generated on: 2010-06-12 20:06:10 : 1276387090*/
App::import('Model', 'F08');

class F08TestCase extends CakeTestCase {
	var $fixtures = array('app.f08', 'app.vehicle', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.identification_type', 'app.identification', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle_type');

	function startTest() {
		$this->F08 =& ClassRegistry::init('F08');
	}

	function endTest() {
		unset($this->F08);
		ClassRegistry::flush();
	}

}
?>