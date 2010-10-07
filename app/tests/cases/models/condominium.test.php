<?php
/* Character Test cases generated on: 2010-06-08 16:06:02 : 1276023602*/
App::import('Model', 'Character');

class CharacterTestCase extends CakeTestCase {
	var $fixtures = array('app.condominium', 'app.identification', 'app.identification_type', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.vehicle', 'app.vehicle_type', 'app.f01');

	function startTest() {
		$this->Character =& ClassRegistry::init('Character');
	}

	function endTest() {
		unset($this->Character);
		ClassRegistry::flush();
	}

}
?>