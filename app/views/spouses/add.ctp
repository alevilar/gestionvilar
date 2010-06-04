
<div class="spouses form">
    <h1>Cliente: <?= $customer['Customer']['name']?></h1>
<?php echo $this->Form->create('Spouse', array('action'=>'add/'.$customer['Customer']['id']));?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Spouse', true)); ?></legend>
	<?php
	echo $this->Form->hidden('customer_natural_id');
        echo $this->Form->input('name');
        echo $this->Form->input('identification_type_id', array('empty'=>'Seleccione'));
        echo $this->Form->input('identification_number');
        echo $this->Form->input('identification_autority');
        echo $this->Form->input('born');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>