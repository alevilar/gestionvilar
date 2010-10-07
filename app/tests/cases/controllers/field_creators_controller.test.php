<?php
/* FieldCreators Test cases generated on: 2010-06-08 15:06:49 : 1276022689*/
App::import('Controller', 'FieldCreators');

class TestFieldCreatorsController extends FieldCreatorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldCreatorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field_creator', 'app.field_coordenate', 'app.field_type');

	function startTest() {
		$this->FieldCreators =& new TestFieldCreatorsController();
		$this->FieldCreators->constructClasses();
	}

	function endTest() {
		unset($this->FieldCreators);
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