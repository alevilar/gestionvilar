<div class="characterTypes form">
<?php echo $this->Form->create('CharacterType');?>
	<fieldset>
 		<legend><?php printf(__('Edit %s', true), __('Character Type', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
                echo $this->Form->input('field_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('CharacterType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('CharacterType.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Character Types', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Characters', true)), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Character', true)), array('controller' => 'characters', 'action' => 'add')); ?> </li>
	</ul>
</div>