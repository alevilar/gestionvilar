<?
$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>
<h1>Formulario 01 de <?= $customer?></h1>

<h4>En proceso.....</h4>