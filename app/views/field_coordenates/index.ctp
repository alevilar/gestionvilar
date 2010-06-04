<div class="fieldCoordenates index">
	<h2><?php __('Field Coordenates');?></h2>


	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('field_creator_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('field_type_id');?></th>
			<th><?php echo $this->Paginator->sort('x');?></th>
			<th><?php echo $this->Paginator->sort('y');?></th>
			<th><?php echo $this->Paginator->sort('w');?></th>
			<th><?php echo $this->Paginator->sort('h');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fieldCoordenates as $fieldCoordenate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fieldCoordenate['FieldCreator']['name'], array('controller' => 'field_creators', 'action' => 'view', $fieldCoordenate['FieldCreator']['id'])); ?>
		</td>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['name']; ?>&nbsp;</td>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['description']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fieldCoordenate['FieldType']['name'], array('controller' => 'field_types', 'action' => 'view', $fieldCoordenate['FieldType']['id'])); ?>
		</td>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['x']; ?>&nbsp;</td>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['y']; ?>&nbsp;</td>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['w']; ?>&nbsp;</td>
		<td><?php echo $fieldCoordenate['FieldCoordenate']['h']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fieldCoordenate['FieldCoordenate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fieldCoordenate['FieldCoordenate']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fieldCoordenate['FieldCoordenate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldCoordenate['FieldCoordenate']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Types', true)), array('controller' => 'field_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Type', true)), array('controller' => 'field_types', 'action' => 'add')); ?> </li>
	</ul>
</div>