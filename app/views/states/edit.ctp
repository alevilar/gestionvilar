<div class="states form">
<?php echo $this->Form->create('State');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('State', true)); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('State.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('State.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('States', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Counties', true)), array('controller' => 'counties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('County', true)), array('controller' => 'counties', 'action' => 'add')); ?> </li>
	</ul>
</div>