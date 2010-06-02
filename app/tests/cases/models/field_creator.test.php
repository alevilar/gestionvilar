<?php
/* FieldCreator Test cases generated on: 2010-06-01 00:06:00 : 1275361680*/
App::import('Model', 'FieldCreator');

class FieldCreatorTestCase extends CakeTestCase {
	var $fixtures = array('app.field_creator', 'app.field_coordenate');

	function startTest() {
		$this->FieldCreator =& ClassRegistry::init('FieldCreator');
	}

	function endTest() {
		unset($this->FieldCreator);
		ClassRegistry::flush();
	}

}
?>