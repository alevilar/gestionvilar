<?php
/* State Test cases generated on: 2010-04-28 19:04:46 : 1272493606*/
App::import('Model', 'State');

class StateTestCase extends CakeTestCase {
	var $fixtures = array('app.state', 'app.county', 'app.city', 'app.customer_home', 'app.customer', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->State =& ClassRegistry::init('State');
	}

	function endTest() {
		unset($this->State);
		ClassRegistry::flush();
	}

}
?>