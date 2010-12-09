<div class="fieldFormFields index">
	<h2><?php __('Field Form Fields');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('field_form_id');?></th>
			<th><?php echo $this->Paginator->sort('field_coordenate_id');?></th>
			<th><?php echo $this->Paginator->sort('value');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fieldFormFields as $fieldFormField):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fieldFormField['FieldFormField']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fieldFormField['FieldForm']['id'], array('controller' => 'field_forms', 'action' => 'view', $fieldFormField['FieldForm']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fieldFormField['FieldCoordenate']['name'], array('controller' => 'field_coordenates', 'action' => 'view', $fieldFormField['FieldCoordenate']['id'])); ?>
		</td>
		<td><?php echo $fieldFormField['FieldFormField']['value']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fieldFormField['FieldFormField']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fieldFormField['FieldFormField']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fieldFormField['FieldFormField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldFormField['FieldFormField']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form Field', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Forms', true)), array('controller' => 'field_forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form', true)), array('controller' => 'field_forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('controller' => 'field_coordenates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add')); ?> </li>
	</ul>
</div>