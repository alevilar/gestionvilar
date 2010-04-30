<div class="customerTypes form">
<?php echo $this->Form->create('CustomerType');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Customer Type', true)); ?></legend>
	<?php
		echo $this->Form->input('customer_id');
		echo $this->Form->input('type');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('marital_status_id');
		echo $this->Form->input('nuptials');
		echo $this->Form->input('spouse');
		echo $this->Form->input('inscription_entity');
		echo $this->Form->input('inscription_number');
		echo $this->Form->input('inscription_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Types', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Marital Statuses', true)), array('controller' => 'marital_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Marital Status', true)), array('controller' => 'marital_statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>