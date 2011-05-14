<div class="fieldCreators index">
	<h2><?php __('Field Creators');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
                        <th><?php echo $this->Paginator->sort('model');?></th>
                        <th><?php echo $this->Paginator->sort('adtivo');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fieldCreators as $fieldCreator):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $fieldCreator['FieldCreator']['id']; ?>&nbsp;</td>
		<td><?php echo $fieldCreator['FieldCreator']['name']; ?>&nbsp;</td>
                <td><?php echo $fieldCreator['FieldCreator']['model']; ?>&nbsp;</td>
                <td><?php echo $fieldCreator['FieldCreator']['activo']; ?>&nbsp;</td>
		<td class="actions">
                    <?php echo $this->Html->link(__('View', true), array('action' => 'view', $fieldCreator['FieldCreator']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fieldCreator['FieldCreator']['id'])); ?>
                    <?php echo $this->Html->link(__('Code', true), array('controller'=>'FieldCoordenates','action' => 'mapear', $fieldCreator['FieldCreator']['id'])); ?>
                    <?php echo $this->Html->link(__('Create Model', true), array('action' => 'model_creation', $fieldCreator['FieldCreator']['id']), null, __('Are you sure? this will delete historical data from curren form?', true)); ?>
                    <?php echo $this->Html->link(__('Update Model', true), array('action' => 'model_update', $fieldCreator['FieldCreator']['id'])); ?>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fieldCreator['FieldCreator']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldCreator['FieldCreator']['id'])); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('action' => 'edit')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('controller' => 'field_coordenates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add')); ?> </li>
	</ul>
</div>