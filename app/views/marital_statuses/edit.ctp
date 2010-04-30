<div class="maritalStatuses form">
<?php echo $this->Form->create('MaritalStatus');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Marital Status', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MaritalStatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MaritalStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Marital Statuses', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Types', true)), array('controller' => 'customer_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Type', true)), array('controller' => 'customer_types', 'action' => 'add')); ?> </li>
	</ul>
</div>