<div class="customerHomes index">
	<h2><?php __('Customer Homes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('adress');?></th>
			<th><?php echo $this->Paginator->sort('number');?></th>
			<th><?php echo $this->Paginator->sort('floor');?></th>
			<th><?php echo $this->Paginator->sort('apartment');?></th>
			<th><?php echo $this->Paginator->sort('postal_code');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th><?php echo $this->Paginator->sort('city_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($customerHomes as $customerHome):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $customerHome['CustomerHome']['id']; ?>&nbsp;</td>
		<td><?php echo $customerHome['CustomerHome']['adress']; ?>&nbsp;</td>
		<td><?php echo $customerHome['CustomerHome']['number']; ?>&nbsp;</td>
		<td><?php echo $customerHome['CustomerHome']['floor']; ?>&nbsp;</td>
		<td><?php echo $customerHome['CustomerHome']['apartment']; ?>&nbsp;</td>
		<td><?php echo $customerHome['CustomerHome']['postal_code']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($customerHome['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $customerHome['Customer']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($customerHome['City']['name'], array('controller' => 'cities', 'action' => 'view', $customerHome['City']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $customerHome['CustomerHome']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $customerHome['CustomerHome']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $customerHome['CustomerHome']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customerHome['CustomerHome']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Home', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Cities', true)), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('City', true)), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>