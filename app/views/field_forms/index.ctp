<div class="fieldForms index">
	<h2><?php __('Field Forms');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('field_creator_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fieldForms as $fieldForm):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fieldForm['FieldForm']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($fieldForm['FieldCreator']['name'], array('controller' => 'field_creators', 'action' => 'view', $fieldForm['FieldCreator']['id'])); ?>
		</td>
		<td><?php echo $fieldForm['FieldForm']['created']; ?>&nbsp;</td>
		<td><?php echo $fieldForm['FieldForm']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fieldForm['FieldForm']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fieldForm['FieldForm']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fieldForm['FieldForm']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldForm['FieldForm']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Form Fields', true)), array('controller' => 'field_form_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Form Field', true)), array('controller' => 'field_form_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>