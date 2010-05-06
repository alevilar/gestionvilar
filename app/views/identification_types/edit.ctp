<div class="identificationTypes form">
<?php echo $this->Form->create('IdentificationType');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Identification Type', true)); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('IdentificationType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('IdentificationType.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identifications', true)), array('controller' => 'identifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification', true)), array('controller' => 'identifications', 'action' => 'add')); ?> </li>
	</ul>
</div>