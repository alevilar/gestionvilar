<?php
/* FieldCoordenates Test cases generated on: 2010-06-01 00:06:31 : 1275362791*/
App::import('Controller', 'FieldCoordenates');

class TestFieldCoordenatesController extends FieldCoordenatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldCoordenatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field_coordenate');

	function startTest() {
		$this->FieldCoordenates =& new TestFieldCoordenatesController();
		$this->FieldCoordenates->constructClasses();
	}

	function endTest() {
		unset($this->FieldCoordenates);
		ClassRegistry::flush();
	}

}
?>