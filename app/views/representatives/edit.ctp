<div class="representatives form">
<?php echo $this->Form->create('Representative');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Representative', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->hidden('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>