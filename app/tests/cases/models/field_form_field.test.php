<?php
/* FieldFormField Test cases generated on: 2010-10-06 02:10:03 : 1286341563*/
App::import('Model', 'FieldFormField');

class FieldFormFieldTestCase extends CakeTestCase {
	var $fixtures = array('app.field_form_field', 'app.field_form', 'app.field_coordenate', 'app.field_creator', 'app.field_type');

	function startTest() {
		$this->FieldFormField =& ClassRegistry::init('FieldFormField');
	}

	function endTest() {
		unset($this->FieldFormField);
		ClassRegistry::flush();
	}

}
?>