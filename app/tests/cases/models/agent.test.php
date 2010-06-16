<?php
/* Agent Test cases generated on: 2010-06-12 20:06:17 : 1276387157*/
App::import('Model', 'Agent');

class AgentTestCase extends CakeTestCase {
	var $fixtures = array('app.agent', 'app.identification_type', 'app.identification', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.customer_legal', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle', 'app.vehicle_type');

	function startTest() {
		$this->Agent =& ClassRegistry::init('Agent');
	}

	function endTest() {
		unset($this->Agent);
		ClassRegistry::flush();
	}

}
?>