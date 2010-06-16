<?php
/* F59m Test cases generated on: 2010-06-12 20:06:28 : 1276387108*/
App::import('Model', 'F59m');

class F59mTestCase extends CakeTestCase {
	var $fixtures = array('app.f59m', 'app.vehicle', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.identification_type', 'app.identification', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle_type');

	function startTest() {
		$this->F59m =& ClassRegistry::init('F59m');
	}

	function endTest() {
		unset($this->F59m);
		ClassRegistry::flush();
	}

}
?>