<?php
class MaritalStatus extends AppModel {
	var $name = 'MaritalStatus';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array('CustomerNatural');

}
?>