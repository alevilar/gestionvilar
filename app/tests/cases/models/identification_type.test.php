<?php
/* IdentificationType Test cases generated on: 2010-04-29 15:04:21 : 1272566241*/
App::import('Model', 'IdentificationType');

class IdentificationTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.identification_type', 'app.identification');

	function startTest() {
		$this->IdentificationType =& ClassRegistry::init('IdentificationType');
	}

	function endTest() {
		unset($this->IdentificationType);
		ClassRegistry::flush();
	}

}
?>