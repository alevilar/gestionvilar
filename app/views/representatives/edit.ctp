<div class="representatives form">
<?php echo $this->Form->create('Representative');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Representative', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Representative.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Representative.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Representatives', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>