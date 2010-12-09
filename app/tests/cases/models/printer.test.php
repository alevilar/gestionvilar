<?php
/* Printer Test cases generated on: 2010-07-05 01:07:04 : 1278303364*/
App::import('Model', 'Printer');

class PrinterTestCase extends CakeTestCase {
	var $fixtures = array('app.printer');

	function startTest() {
		$this->Printer =& ClassRegistry::init('Printer');
	}

	function endTest() {
		unset($this->Printer);
		ClassRegistry::flush();
	}

}
?>