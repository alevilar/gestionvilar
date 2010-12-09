<?php
/* FieldForms Test cases generated on: 2010-10-06 02:10:04 : 1286341684*/
App::import('Controller', 'FieldForms');

class TestFieldFormsController extends FieldFormsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldFormsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field_form', 'app.field_creator', 'app.field_coordenate', 'app.field_type', 'app.field_form_field');

	function startTest() {
		$this->FieldForms =& new TestFieldFormsController();
		$this->FieldForms->constructClasses();
	}

	function endTest() {
		unset($this->FieldForms);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>