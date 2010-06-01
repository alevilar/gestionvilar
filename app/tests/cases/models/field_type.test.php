<?php
/* FieldType Test cases generated on: 2010-06-01 00:06:25 : 1275361705*/
App::import('Model', 'FieldType');

class FieldTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.field_type', 'app.field_coordenate');

	function startTest() {
		$this->FieldType =& ClassRegistry::init('FieldType');
	}

	function endTest() {
		unset($this->FieldType);
		ClassRegistry::flush();
	}

}
?>