<div class="customers view">
<h2><?php  __('Customer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $customer['Customer']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $customer['Customer']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Born'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $customer['Customer']['born']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $customer['Customer']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $customer['Customer']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Customer', true)), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Customer', true)), array('action' => 'delete', $customer['Customer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customer['Customer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Homes', true)), array('controller' => 'customer_homes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Home', true)), array('controller' => 'customer_homes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Types', true)), array('controller' => 'customer_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Type', true)), array('controller' => 'customer_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identifications', true)), array('controller' => 'identifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification', true)), array('controller' => 'identifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Representatives', true)), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Representative', true)), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Vehicles', true)), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Vehicle', true)), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Customer Homes', true));?></h3>
	<?php if (!empty($customer['CustomerHome'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Address'); ?></th>
		<th><?php __('Number'); ?></th>
		<th><?php __('Floor'); ?></th>
		<th><?php __('Apartment'); ?></th>
		<th><?php __('Postal Code'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th><?php __('City Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customer['CustomerHome'] as $customerHome):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $customerHome['id'];?></td>
			<td><?php echo $customerHome['address'];?></td>
			<td><?php echo $customerHome['number'];?></td>
			<td><?php echo $customerHome['floor'];?></td>
			<td><?php echo $customerHome['apartment'];?></td>
			<td><?php echo $customerHome['postal_code'];?></td>
			<td><?php echo $customerHome['customer_id'];?></td>
			<td><?php echo $customerHome['city_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'customer_homes', 'action' => 'view', $customerHome['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'customer_homes', 'action' => 'edit', $customerHome['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'customer_homes', 'action' => 'delete', $customerHome['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $customerHome['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Home', true)), array('controller' => 'customer_homes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Customer Types', true));?></h3>
	<?php if (!empty($customer['CustomerType'])):?>
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
		foreach ($customer['CustomerType'] as $customerType):
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
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Identifications', true));?></h3>
	<?php if (!empty($customer['Identification'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Idenfication Type Id'); ?></th>
		<th><?php __('Number'); ?></th>
		<th><?php __('Authority Name'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customer['Identification'] as $identification):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $identification['id'];?></td>
			<td><?php echo $identification['idenfication_type_id'];?></td>
			<td><?php echo $identification['number'];?></td>
			<td><?php echo $identification['authority_name'];?></td>
			<td><?php echo $identification['customer_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'identifications', 'action' => 'view', $identification['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'identifications', 'action' => 'edit', $identification['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'identifications', 'action' => 'delete', $identification['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $identification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification', true)), array('controller' => 'identifications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Representatives', true));?></h3>
	<?php if (!empty($customer['Representative'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Surname'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customer['Representative'] as $representative):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $representative['id'];?></td>
			<td><?php echo $representative['name'];?></td>
			<td><?php echo $representative['surname'];?></td>
			<td><?php echo $representative['customer_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'representatives', 'action' => 'view', $representative['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'representatives', 'action' => 'edit', $representative['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'representatives', 'action' => 'delete', $representative['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $representative['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Representative', true)), array('controller' => 'representatives', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Vehicles', true));?></h3>
	<?php if (!empty($customer['Vehicle'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th><?php __('Fabrication Certificate'); ?></th>
		<th><?php __('Brand'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Model'); ?></th>
		<th><?php __('Motor Brand'); ?></th>
		<th><?php __('Motor Number'); ?></th>
		<th><?php __('Chasis Brand'); ?></th>
		<th><?php __('Chasis Number'); ?></th>
		<th><?php __('Use'); ?></th>
		<th><?php __('Adquisition Value'); ?></th>
		<th><?php __('Adquisition Date'); ?></th>
		<th><?php __('Adquisition Evidence Element'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($customer['Vehicle'] as $vehicle):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $vehicle['id'];?></td>
			<td><?php echo $vehicle['customer_id'];?></td>
			<td><?php echo $vehicle['fabrication_certificate'];?></td>
			<td><?php echo $vehicle['brand'];?></td>
			<td><?php echo $vehicle['type'];?></td>
			<td><?php echo $vehicle['model'];?></td>
			<td><?php echo $vehicle['motor_brand'];?></td>
			<td><?php echo $vehicle['motor_number'];?></td>
			<td><?php echo $vehicle['chasis_brand'];?></td>
			<td><?php echo $vehicle['chasis_number'];?></td>
			<td><?php echo $vehicle['use'];?></td>
			<td><?php echo $vehicle['adquisition_value'];?></td>
			<td><?php echo $vehicle['adquisition_date'];?></td>
			<td><?php echo $vehicle['adquisition_evidence_element'];?></td>
			<td><?php echo $vehicle['created'];?></td>
			<td><?php echo $vehicle['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'vehicles', 'action' => 'view', $vehicle['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'vehicles', 'action' => 'edit', $vehicle['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'vehicles', 'action' => 'delete', $vehicle['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $vehicle['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Vehicle', true)), array('controller' => 'vehicles', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
