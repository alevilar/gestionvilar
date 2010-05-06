<?php
/* County Test cases generated on: 2010-04-28 19:04:44 : 1272493604*/
App::import('Model', 'County');

class CountyTestCase extends CakeTestCase {
	var $fixtures = array('app.county', 'app.state', 'app.city', 'app.customer_home');

	function startTest() {
		$this->County =& ClassRegistry::init('County');
	}

	function endTest() {
		unset($this->County);
		ClassRegistry::flush();
	}

}
?>