<div class="maritalStatuses view">
<h2><?php  __('Marital Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maritalStatus['MaritalStatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $maritalStatus['MaritalStatus']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Marital Status', true)), array('action' => 'edit', $maritalStatus['MaritalStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Marital Status', true)), array('action' => 'delete', $maritalStatus['MaritalStatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $maritalStatus['MaritalStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Marital Statuses', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Marital Status', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Types', true)), array('controller' => 'customer_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Type', true)), array('controller' => 'customer_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Customer Types', true));?></h3>
	<?php if (!empty($maritalStatus['CustomerNatural'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Surname'); ?></th>
		<th><?php __('Marital Status Id'); ?></th>
		<th><?php __('Nuptials'); ?></th>
		<th><?php __('Spouse'); ?></th>
		<th><?php __('Inscription Entity'); ?></th>
		<th><?php __('Inscription Number'); ?></th>
		<th><?php __('Inscription Date'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($maritalStatus['CustomerNatural'] as $customerType):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $customerType['id'];?></td>
			<td><?php echo $customerType['customer_id'];?></td>
			<td><?php echo $customerType['type'];?></td>
			<td><?php echo $customerType['name'];?></td>
			<td><?php echo $customerType['surname'];?></td>
			<td><?php echo $customerType['marital_status_id'];?></td>
			<td><?php echo $customerType['nuptials'];?></td>
			<td><?php echo $customerType['spouse'];?></td>
			<td><?php echo $customerType['inscription_entity'];?></td>
			<td><?php echo $customerType['inscription_number'];?></td>
			<td><?php echo $customerType['inscription_date'];?></td>
			<td><?php echo $customerType['created'];?></td>
			<td><?php echo $customerType['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'customer_types', 'action' => 'view', $customerType['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'customer_types', 'action' => 'edit', $customerType['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'customer_types', 'action' => 'delete', $customerType['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customerType['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Type', true)), array('controller' => 'customer_types', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
