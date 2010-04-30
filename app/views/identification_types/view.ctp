<div class="identificationTypes view">
<h2><?php  __('Identification Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $identificationType['IdentificationType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $identificationType['IdentificationType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Identification Type', true)), array('action' => 'edit', $identificationType['IdentificationType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Identification Type', true)), array('action' => 'delete', $identificationType['IdentificationType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $identificationType['IdentificationType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification Type', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identifications', true)), array('controller' => 'identifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification', true)), array('controller' => 'identifications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Identifications', true));?></h3>
	<?php if (!empty($identificationType['Identification'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Identification Type Id'); ?></th>
		<th><?php __('Number'); ?></th>
		<th><?php __('Authority Name'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($identificationType['Identification'] as $identification):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $identification['id'];?></td>
			<td><?php echo $identification['identification_type_id'];?></td>
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
