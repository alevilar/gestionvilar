<div class="fieldCreators view">
<h2><?php  __('Field Creator');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldCreator['FieldCreator']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldCreator['FieldCreator']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Field Creator', true)), array('action' => 'edit', $fieldCreator['FieldCreator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Field Creator', true)), array('action' => 'delete', $fieldCreator['FieldCreator']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldCreator['FieldCreator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('controller' => 'field_coordenates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Field Coordenates', true));?></h3>
	<?php if (!empty($fieldCreator['FieldCoordenate'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Field Creator Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Field Type Id'); ?></th>
		<th><?php __('X'); ?></th>
		<th><?php __('Y'); ?></th>
		<th><?php __('W'); ?></th>
		<th><?php __('H'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($fieldCreator['FieldCoordenate'] as $fieldCoordenate):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fieldCoordenate['id'];?></td>
			<td><?php echo $fieldCoordenate['field_creator_id'];?></td>
			<td><?php echo $fieldCoordenate['name'];?></td>
			<td><?php echo $fieldCoordenate['description'];?></td>
			<td><?php echo $fieldCoordenate['field_type_id'];?></td>
			<td><?php echo $fieldCoordenate['x'];?></td>
			<td><?php echo $fieldCoordenate['y'];?></td>
			<td><?php echo $fieldCoordenate['w'];?></td>
			<td><?php echo $fieldCoordenate['h'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'field_coordenates', 'action' => 'view', $fieldCoordenate['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'field_coordenates', 'action' => 'edit', $fieldCoordenate['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'field_coordenates', 'action' => 'delete', $fieldCoordenate['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldCoordenate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
