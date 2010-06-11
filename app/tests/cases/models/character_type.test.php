<?php
/* CharacterType Test cases generated on: 2010-06-11 02:06:55 : 1276233055*/
App::import('Model', 'CharacterType');

class CharacterTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.character_type', 'app.character', 'app.identification_type', 'app.identification', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.vehicle', 'app.vehicle_type');

	function startTest() {
		$this->CharacterType =& ClassRegistry::init('CharacterType');
	}

	function endTest() {
		unset($this->CharacterType);
		ClassRegistry::flush();
	}

}
?>