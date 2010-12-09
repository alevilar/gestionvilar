<div class="actions span-4">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Printer', true)), array('action' => 'add')); ?></li>
	</ul>
</div>

<div class="printers index span-20 last">
	<h2><?php __('Printers');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('Coordenada Horizontal - X', 'x');?></th>
			<th><?php echo $this->Paginator->sort('Coordenada Vertical - Y');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($printers as $printer):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $printer['Printer']['name']; ?>&nbsp;</td>
                <td><?php echo $printer['Printer']['x']; ?>&nbsp;</td>
		<td><?php echo $printer['Printer']['y']; ?>&nbsp;</td>
		<td><?php echo date('d/m/y (H:i)', strtotime($printer['Printer']['created'])); ?>&nbsp;</td>
		<td><?php echo date('d/m/y (H:i)', strtotime($printer['Printer']['modified'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $printer['Printer']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $printer['Printer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $printer['Printer']['id'])); ?>
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
