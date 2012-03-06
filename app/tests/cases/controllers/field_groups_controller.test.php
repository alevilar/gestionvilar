<?php
/* FieldGroups Test cases generated on: 2011-06-30 18:06:54 : 1309470294*/
App::import('Controller', 'FieldGroups');

class TestFieldGroupsController extends FieldGroupsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldGroupsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field_group', 'app.field_creator', 'app.field_coordenate', 'app.field_type', 'app.field_form_field', 'app.field_form', 'app.vehicle', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.identification_type', 'app.identification', 'app.customer_legal', 'app.customer_home', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle_type');

	function startTest() {
		$this->FieldGroups =& new TestFieldGroupsController();
		$this->FieldGroups->constructClasses();
	}

	function endTest() {
		unset($this->FieldGroups);
		ClassRegistry::flush();
	}

}
?>