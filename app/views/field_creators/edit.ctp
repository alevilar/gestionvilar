<div class="fieldCreators form">
<?php echo $this->Form->create('FieldCreator');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Field Creator', true)); ?></legend>
	<?php
                if ( !empty($this->data['FieldCreator']['id'] )) {
                    echo $this->Form->input('id');
                }
		echo $this->Form->input('name');
                echo $this->Form->input('model');
                echo $this->Form->input('activo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('FieldCreator.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('FieldCreator.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('controller' => 'field_coordenates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('controller' => 'field_coordenates', 'action' => 'add')); ?> </li>
	</ul>
</div>