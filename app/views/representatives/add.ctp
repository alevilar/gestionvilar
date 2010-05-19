<div class="representatives form">
    <h1>Cliente: <?= $customer['Customer']['name']?></h1>
<?php echo $this->Form->create('Representative', array('action'=>'add/'.$customer['Customer']['id']));?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Representative', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->hidden('customer_id');

                echo $this->Form->input('identification_type_id',array('empty'=>'Seleccione'));
                echo $this->Form->input('identification_number');
                echo $this->Form->input('nationality_type', array('empty'=>'Seleccione', 'label'=>'Nacionalidad'));
                echo $this->Form->input('nationality', array('label'=>'País'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>