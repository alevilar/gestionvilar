<?

$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>
<h1>Formulario <?= "$form_name"?> -- Dominio: <?= $this->data['Vehicle']['patente']?></h1>



<? //echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>

<div class="span-12">
<?php
echo $this->Form->create($form_name, array('url'=> "/field_creators/addForm/$form_name/$vehicle_id"));

if (!empty($this->data[$form_name]['id'])) {
    echo $this->Form->input('id');
}

echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));

foreach($formInputs as $inputs){
    echo $this->Form->inputs($inputs);
}

?>
</div>
<div class="span-12 last">
<?
echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));
echo $this->element('customer_form_view', array('customer'=>$this->data['Vehicle']['Customer']));
?>

</div>


<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>

