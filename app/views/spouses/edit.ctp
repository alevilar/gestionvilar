
<div class="spouses form">
    <h1>Editando Cóyuge</h1>
<?php echo $this->Form->create('Spouse');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Spouse', true)); ?></legend>
	<?php
        echo $this->Form->input('id');
	echo $this->Form->hidden('customer_natural_id');
        echo $this->Form->input('name');
        echo $this->Form->input('identification_type_id', array('empty'=>'Seleccione'));
        echo $this->Form->input('identification_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>