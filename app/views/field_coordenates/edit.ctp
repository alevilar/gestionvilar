<div class="fieldCoordenates form">
<?php echo $this->Form->create('FieldCoordenate');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Field Coordenate', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('field_creator_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('field_type_id');
		echo $this->Form->input('x');
		echo $this->Form->input('y');
		echo $this->Form->input('w');
		echo $this->Form->input('h');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FieldCoordenate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FieldCoordenate.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Types', true)), array('controller' => 'field_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Type', true)), array('controller' => 'field_types', 'action' => 'add')); ?> </li>
	</ul>
</div>