<?php
/* FieldGroup Test cases generated on: 2011-06-30 18:06:24 : 1309470264*/
App::import('Model', 'FieldGroup');

class FieldGroupTestCase extends CakeTestCase {
	var $fixtures = array('app.field_group', 'app.field_creator', 'app.field_coordenate', 'app.field_type', 'app.field_form_field', 'app.field_form', 'app.vehicle', 'app.customer', 'app.customer_natural', 'app.marital_status', 'app.spouse', 'app.identification_type', 'app.identification', 'app.customer_legal', 'app.customer_home', 'app.representative', 'app.character', 'app.character_type', 'app.vehicle_type');

	function startTest() {
		$this->FieldGroup =& ClassRegistry::init('FieldGroup');
	}

	function endTest() {
		unset($this->FieldGroup);
		ClassRegistry::flush();
	}

}
?>