<?php
/* CustomerType Test cases generated on: 2010-04-28 19:04:44 : 1272493604*/
App::import('Model', 'CustomerType');

class CustomerTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.customer_type', 'app.customer', 'app.marital_status');

	function startTest() {
		$this->CustomerType =& ClassRegistry::init('CustomerType');
	}

	function endTest() {
		unset($this->CustomerType);
		ClassRegistry::flush();
	}

}
?>