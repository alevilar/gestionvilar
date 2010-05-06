<div class="customerTypes index">
	<h2><?php __('Customer Types');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('surname');?></th>
			<th><?php echo $this->Paginator->sort('marital_status_id');?></th>
			<th><?php echo $this->Paginator->sort('nuptials');?></th>
			<th><?php echo $this->Paginator->sort('spouse');?></th>
			<th><?php echo $this->Paginator->sort('inscription_entity');?></th>
			<th><?php echo $this->Paginator->sort('inscription_number');?></th>
			<th><?php echo $this->Paginator->sort('inscription_date');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($customerTypes as $customerType):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $customerType['CustomerType']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($customerType['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $customerType['Customer']['id'])); ?>
		</td>
		<td><?php echo $customerType['CustomerType']['type']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['name']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['surname']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($customerType['MaritalStatus']['name'], array('controller' => 'marital_statuses', 'action' => 'view', $customerType['MaritalStatus']['id'])); ?>
		</td>
		<td><?php echo $customerType['CustomerType']['nuptials']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['spouse']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['inscription_entity']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['inscription_number']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['inscription_date']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['created']; ?>&nbsp;</td>
		<td><?php echo $customerType['CustomerType']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $customerType['CustomerType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $customerType['CustomerType']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $customerType['CustomerType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customerType['CustomerType']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Type', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Marital Statuses', true)), array('controller' => 'marital_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Marital Status', true)), array('controller' => 'marital_statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>