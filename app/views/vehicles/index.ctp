<div class="vehicles index">
	<h2><?php __('Vehicles');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th><?php echo $this->Paginator->sort('fabrication_certificate');?></th>
			<th><?php echo $this->Paginator->sort('brand');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('model');?></th>
			<th><?php echo $this->Paginator->sort('motor_brand');?></th>
			<th><?php echo $this->Paginator->sort('motor_number');?></th>
			<th><?php echo $this->Paginator->sort('chasis_brand');?></th>
			<th><?php echo $this->Paginator->sort('chasis_number');?></th>
			<th><?php echo $this->Paginator->sort('use');?></th>
			<th><?php echo $this->Paginator->sort('adquisition_value');?></th>
			<th><?php echo $this->Paginator->sort('adquisition_date');?></th>
			<th><?php echo $this->Paginator->sort('adquisition_evidence_element');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($vehicles as $vehicle):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $vehicle['Vehicle']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vehicle['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $vehicle['Customer']['id'])); ?>
		</td>
		<td><?php echo $vehicle['Vehicle']['fabrication_certificate']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['brand']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['type']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['model']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['motor_brand']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['motor_number']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['chasis_brand']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['chasis_number']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['use']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['adquisition_value']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['adquisition_date']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['adquisition_evidence_element']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['created']; ?>&nbsp;</td>
		<td><?php echo $vehicle['Vehicle']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $vehicle['Vehicle']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $vehicle['Vehicle']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $vehicle['Vehicle']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $vehicle['Vehicle']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Vehicle', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>