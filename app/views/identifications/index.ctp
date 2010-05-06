<div class="identifications index">
	<h2><?php __('Identifications');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('identification_type_id');?></th>
			<th><?php echo $this->Paginator->sort('number');?></th>
			<th><?php echo $this->Paginator->sort('authority_name');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($identifications as $identification):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $identification['Identification']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($identification['IdentificationType']['name'], array('controller' => 'identification_types', 'action' => 'view', $identification['IdentificationType']['id'])); ?>
		</td>
		<td><?php echo $identification['Identification']['number']; ?>&nbsp;</td>
		<td><?php echo $identification['Identification']['authority_name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($identification['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $identification['Customer']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $identification['Identification']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $identification['Identification']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $identification['Identification']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $identification['Identification']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('controller' => 'identification_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification Type', true)), array('controller' => 'identification_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>