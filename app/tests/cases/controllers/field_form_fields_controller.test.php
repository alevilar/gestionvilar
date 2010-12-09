<?php
/* FieldFormFields Test cases generated on: 2010-10-06 02:10:36 : 1286341596*/
App::import('Controller', 'FieldFormFields');

class TestFieldFormFieldsController extends FieldFormFieldsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldFormFieldsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field_form_field', 'app.field_form', 'app.field_coordenate', 'app.field_creator', 'app.field_type');

	function startTest() {
		$this->FieldFormFields =& new TestFieldFormFieldsController();
		$this->FieldFormFields->constructClasses();
	}

	function endTest() {
		unset($this->FieldFormFields);
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