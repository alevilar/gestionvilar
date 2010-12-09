<div class="fieldFormFields view">
<h2><?php  __('Field Form Field');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldFormField['FieldFormField']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field Form'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fieldFormField['FieldForm']['id'], array('controller' => 'field_forms', 'action' => 'view', $fieldFormField['FieldForm']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field Coordenate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fieldFormField['FieldCoordenate']['name'], array('controller' => 'field_coordenates', 'action' => 'view', $fieldFormField['FieldCoordenate']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldFormField['FieldFormField']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Field Form Field', true)), array('action' => 'edit', $fieldFormField['FieldFormField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Field Form Field', true)), array('action' => 'delete', $fieldFormField['FieldFormField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldFormField['FieldFormField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Form Fields', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form Field', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Forms', true)), array('controller' => 'field_forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form', true)), array('controller' => 'field_forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('controller' => 'field_coordenates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add')); ?> </li>
	</ul>
</div>
