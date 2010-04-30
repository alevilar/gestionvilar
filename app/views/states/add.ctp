<div class="states form">
<?php echo $this->Form->create('State');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('State', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('States', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Counties', true)), array('controller' => 'counties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('County', true)), array('controller' => 'counties', 'action' => 'add')); ?> </li>
	</ul>
</div>