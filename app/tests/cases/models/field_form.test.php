<?php
/* FieldForm Test cases generated on: 2010-10-06 02:10:47 : 1286341667*/
App::import('Model', 'FieldForm');

class FieldFormTestCase extends CakeTestCase {
	var $fixtures = array('app.field_form', 'app.field_creator', 'app.field_coordenate', 'app.field_type', 'app.field_form_field');

	function startTest() {
		$this->FieldForm =& ClassRegistry::init('FieldForm');
	}

	function endTest() {
		unset($this->FieldForm);
		ClassRegistry::flush();
	}

}
?>