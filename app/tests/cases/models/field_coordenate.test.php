<?php
/* FieldCoordenate Test cases generated on: 2010-06-01 00:06:36 : 1275362856*/
App::import('Model', 'FieldCoordenate');

class FieldCoordenateTestCase extends CakeTestCase {
	var $fixtures = array('app.field_coordenate', 'app.field_creator', 'app.field_type');

	function startTest() {
		$this->FieldCoordenate =& ClassRegistry::init('FieldCoordenate');
	}

	function endTest() {
		unset($this->FieldCoordenate);
		ClassRegistry::flush();
	}

}
?>