<?php
/* CustomerHome Test cases generated on: 2010-04-28 19:04:44 : 1272493604*/
App::import('Model', 'CustomerHome');

class CustomerHomeTestCase extends CakeTestCase {
	var $fixtures = array('app.customer_home', 'app.customer', 'app.city', 'app.county', 'app.state');

	function startTest() {
		$this->CustomerHome =& ClassRegistry::init('CustomerHome');
	}

	function endTest() {
		unset($this->CustomerHome);
		ClassRegistry::flush();
	}

}
?>