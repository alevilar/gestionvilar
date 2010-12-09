<div class="fieldFormFields form">
<?php echo $this->Form->create('FieldFormField');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Field Form Field', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('field_form_id');
		echo $this->Form->input('field_coordenate_id');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FieldFormField.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FieldFormField.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Form Fields', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Forms', true)), array('controller' => 'field_forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form', true)), array('controller' => 'field_forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('controller' => 'field_coordenates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add')); ?> </li>
	</ul>
</div>