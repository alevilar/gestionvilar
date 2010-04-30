<div class="customerHomes form">
<?php echo $this->Form->create('CustomerHome');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Customer Home', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('adress');
		echo $this->Form->input('number');
		echo $this->Form->input('floor');
		echo $this->Form->input('apartment');
		echo $this->Form->input('postal_code');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('city_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CustomerHome.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CustomerHome.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Homes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Cities', true)), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('City', true)), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>