<div class="identifications form">
<?php echo $this->Form->create('Identification');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Identification', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('identification_type_id');
		echo $this->Form->input('number');
		echo $this->Form->input('authority_name');
		echo $this->Form->input('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Identification.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Identification.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identifications', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('controller' => 'identification_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification Type', true)), array('controller' => 'identification_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>