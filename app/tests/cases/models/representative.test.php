<?php
/* Representative Test cases generated on: 2010-04-28 19:04:45 : 1272493605*/
App::import('Model', 'Representative');

class RepresentativeTestCase extends CakeTestCase {
	var $fixtures = array('app.representative', 'app.customer', 'app.customer_home', 'app.city', 'app.county', 'app.state', 'app.customer_type', 'app.marital_status', 'app.identification', 'app.idenfication_type', 'app.vehicle');

	function startTest() {
		$this->Representative =& ClassRegistry::init('Representative');
	}

	function endTest() {
		unset($this->Representative);
		ClassRegistry::flush();
	}

}
?>