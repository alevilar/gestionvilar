<?php
/* City Test cases generated on: 2010-04-28 19:04:43 : 1272493603*/
App::import('Model', 'City');

class CityTestCase extends CakeTestCase {
	var $fixtures = array('app.city', 'app.county', 'app.customer_home');

	function startTest() {
		$this->City =& ClassRegistry::init('City');
	}

	function endTest() {
		unset($this->City);
		ClassRegistry::flush();
	}

}
?>