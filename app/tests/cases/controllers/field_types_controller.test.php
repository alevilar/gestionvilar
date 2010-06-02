<?php
/* FieldTypes Test cases generated on: 2010-06-01 00:06:39 : 1275362019*/
App::import('Controller', 'FieldTypes');

class TestFieldTypesController extends FieldTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field_type', 'app.field_coordenate');

	function startTest() {
		$this->FieldTypes =& new TestFieldTypesController();
		$this->FieldTypes->constructClasses();
	}

	function endTest() {
		unset($this->FieldTypes);
		ClassRegistry::flush();
	}

}
?>