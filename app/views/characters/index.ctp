<div class="characters index">
	<h2><?php __('Characters');?></h2>
        <table cellpadding="0" cellspacing="0" class="span-24">
	<tr>
			<th><?php echo $this->Paginator->sort('porcentaje');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('provincia');?></th>
                        <th><?php echo $this->Paginator->sort('Cliente','Customer.name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($characters as $character):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $character['Character']['porcentaje']; ?>&nbsp;</td>
		<td><?php echo $character['Character']['name']; ?>&nbsp;</td>
		<td><?php echo $character['Character']['provincia']; ?>&nbsp;</td>
		<td>
                    <?php if (empty($character['Customer']['id'])) echo "<b>Actor genérico</b>"?>
			<?php echo $this->Html->link($character['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $character['Customer']['id'])); ?>
		</td>
		<td class="actions span-5 last">
			<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $character['Character']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $character['Character']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $character['Character']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $character['Character']['id'])); ?>
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