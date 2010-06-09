<div class="condominia index">
	<h2><?php __('Condominia');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('porcentaje');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('calle');?></th>
			<th><?php echo $this->Paginator->sort('numero_calle');?></th>
			<th><?php echo $this->Paginator->sort('piso');?></th>
			<th><?php echo $this->Paginator->sort('depto');?></th>
			<th><?php echo $this->Paginator->sort('cp');?></th>
			<th><?php echo $this->Paginator->sort('localidad');?></th>
			<th><?php echo $this->Paginator->sort('departamento');?></th>
			<th><?php echo $this->Paginator->sort('provincia');?></th>
			<th><?php echo $this->Paginator->sort('identification_id');?></th>
			<th><?php echo $this->Paginator->sort('fecha_nacimiento');?></th>
			<th><?php echo $this->Paginator->sort('marital_status_id');?></th>
			<th><?php echo $this->Paginator->sort('nupcia');?></th>
			<th><?php echo $this->Paginator->sort('conyuge');?></th>
			<th><?php echo $this->Paginator->sort('personeria_otorgada');?></th>
			<th><?php echo $this->Paginator->sort('inscripcion');?></th>
			<th><?php echo $this->Paginator->sort('fecha_inscripcion');?></th>
			<th><?php echo $this->Paginator->sort('customer_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($condominia as $condominium):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $condominium['Condominium']['id']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['porcentaje']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['name']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['calle']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['numero_calle']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['piso']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['depto']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['cp']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['localidad']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['departamento']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['provincia']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['identification_id']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['fecha_nacimiento']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($condominium['MaritalStatus']['name'], array('controller' => 'marital_statuses', 'action' => 'view', $condominium['MaritalStatus']['id'])); ?>
		</td>
		<td><?php echo $condominium['Condominium']['nupcia']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['conyuge']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['personeria_otorgada']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['inscripcion']; ?>&nbsp;</td>
		<td><?php echo $condominium['Condominium']['fecha_inscripcion']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($condominium['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $condominium['Customer']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $condominium['Condominium']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $condominium['Condominium']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $condominium['Condominium']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $condominium['Condominium']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Condominium', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('controller' => 'identification_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification Type', true)), array('controller' => 'identification_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Marital Statuses', true)), array('controller' => 'marital_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Marital Status', true)), array('controller' => 'marital_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>