<div class="actions column">
	<p><h3><?php __('Actions'); ?></h3></p>
        <br>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Representative', true)), array('action' => 'edit', $representative['Representative']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Representative', true)), array('action' => 'delete', $representative['Representative']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $representative['Representative']['id'])); ?> </li>
	</ul>
</div>
<? //debug($representative)?>
<div class="representatives view">
<h2><?php  __('Representative');?></h2>
	<?php $i = 0; $class = ' class="altrow"';?>
		<b><?php __('Name'); ?>:</b> <?php echo $representative['Representative']['name']; ?><br>

		<b><?php __('Surname'); ?>:</b> <?php echo $representative['Representative']['surname']; ?><br>
                
                <b>Identificación:</b> <?= @$representative['IdentificationType']['name'].' '.$representative['Representative']['identification_number']?><br>

                <b>Nacionalidad:</b> <?= @$representativeType[$representative['Representative']['nationality_type']]?><br>

                    <b>País:</b> <?= $representative['Representative']['nationality']?>
	
</div>

