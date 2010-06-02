<?
$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>
<h1>Formulario 12 de <?= $customer?></h1>


<? echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>

<?php
echo $this->Form->create('F12', array('url'=> "/field_creators/addForm/F12/$vehicle_id"));

if (!empty($this->data['F12']['id'])) {
    echo $this->Form->input('id');
}

echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));


$text_obs = 'He verificado personalmente la autenticidad de los datos que figuran en el presente formulario y me hago personalmente responsable civil y criminalmente por los errores u omicionesen que pudiera incurrir, sin prejuicio de las que a la empresa le correspondan.';
echo $this->Form->input('observaciones', array('value'=>strtoupper($text_obs)));

echo $this->Form->input('lugar');

echo $this->Jqform->date('fecha');

echo $this->element('customer_form_view', array('customer'=>$this->data['Vehicle']['Customer']));

?>


<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>