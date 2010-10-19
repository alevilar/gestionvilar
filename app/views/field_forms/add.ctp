<div class="fieldForms form">
<?php echo $this->Form->create('FieldForm');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Field Form', true)); ?></legend>
	<?php
		echo $this->Form->input('field_creator_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Forms', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Form Fields', true)), array('controller' => 'field_form_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form Field', true)), array('controller' => 'field_form_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>