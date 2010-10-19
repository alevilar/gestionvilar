<div class="fieldForms view">
<h2><?php  __('Field Form');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldForm['FieldForm']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field Creator'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fieldForm['FieldCreator']['name'], array('controller' => 'field_creators', 'action' => 'view', $fieldForm['FieldCreator']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldForm['FieldForm']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldForm['FieldForm']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Field Form', true)), array('action' => 'edit', $fieldForm['FieldForm']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Field Form', true)), array('action' => 'delete', $fieldForm['FieldForm']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldForm['FieldForm']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Forms', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Form Fields', true)), array('controller' => 'field_form_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form Field', true)), array('controller' => 'field_form_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Field Form Fields', true));?></h3>
	<?php if (!empty($fieldForm['FieldFormField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Field Form Id'); ?></th>
		<th><?php __('Field Coordenate Id'); ?></th>
		<th><?php __('Value'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fieldForm['FieldFormField'] as $fieldFormField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fieldFormField['id'];?></td>
			<td><?php echo $fieldFormField['field_form_id'];?></td>
			<td><?php echo $fieldFormField['field_coordenate_id'];?></td>
			<td><?php echo $fieldFormField['value'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'field_form_fields', 'action' => 'view', $fieldFormField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'field_form_fields', 'action' => 'edit', $fieldFormField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'field_form_fields', 'action' => 'delete', $fieldFormField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldFormField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form Field', true)), array('controller' => 'field_form_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
