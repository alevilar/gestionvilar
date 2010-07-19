<?
$form_name = 'F01';

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

// Se certifica que las condiciones de identificación que figuran en esta solicitu fueron verificadas con el certificado de fabricación y con el automotor cuya inscripción se solicita a favor el señor'));
echo $this->Form->input('se_certifica_obs', array('label'=>'Observación concesionaria o Industria Terminal'));

echo $this->Form->input('observaciones');

echo $this->element('field_forms/spouses_data');
echo $this->element('field_forms/character_data');
echo $this->element('representative_form_ajax_input');
?>
</div>
<div class="span-12 last">
<?
echo $this->element('customer_form_view', array('customer'=>$this->data['Vehicle']['Customer'])); 
echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));
?>

</div>


<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>

