<?php
/* MaritalStatus Test cases generated on: 2010-04-28 19:04:45 : 1272493605*/
App::import('Model', 'MaritalStatus');

class MaritalStatusTestCase extends CakeTestCase {
	var $fixtures = array('app.marital_status', 'app.customer_type', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.identification', 'app.idenfication_type', 'app.representative', 'app.vehicle');

	function startTest() {
		$this->MaritalStatus =& ClassRegistry::init('MaritalStatus');
	}

	function endTest() {
		unset($this->MaritalStatus);
		ClassRegistry::flush();
	}

}
?>