<div class="characterTypes view">
<h2><?php  __('Character Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $characterType['CharacterType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $characterType['CharacterType']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Character Type', true)), array('action' => 'edit', $characterType['CharacterType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Character Type', true)), array('action' => 'delete', $characterType['CharacterType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $characterType['CharacterType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Character Types', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Character Type', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Characters', true)), array('controller' => 'characters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Character', true)), array('controller' => 'characters', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php printf(__('Related %s', true), __('Characters', true));?></h3>
	<?php if (!empty($characterType['Character'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Porcentaje'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Calle'); ?></th>
		<th><?php __('Numero Calle'); ?></th>
		<th><?php __('Piso'); ?></th>
		<th><?php __('Depto'); ?></th>
		<th><?php __('Cp'); ?></th>
		<th><?php __('Localidad'); ?></th>
		<th><?php __('Departamento'); ?></th>
		<th><?php __('Provincia'); ?></th>
		<th><?php __('Identification Type Id'); ?></th>
		<th><?php __('Identification Number'); ?></th>
		<th><?php __('Nationality Type Id'); ?></th>
		<th><?php __('Identification Authority'); ?></th>
		<th><?php __('Fecha Nacimiento'); ?></th>
		<th><?php __('Marital Status Id'); ?></th>
		<th><?php __('Nupcia'); ?></th>
		<th><?php __('Conyuge'); ?></th>
		<th><?php __('Personeria Otorgada'); ?></th>
		<th><?php __('Inscripcion'); ?></th>
		<th><?php __('Fecha Inscripcion'); ?></th>
		<th><?php __('Apoderado Name'); ?></th>
		<th><?php __('Apoderado Identification Type Id'); ?></th>
		<th><?php __('Apoderado Identification Number'); ?></th>
		<th><?php __('Apoderado Nationality Type'); ?></th>
		<th><?php __('Apoderado Identification Auth'); ?></th>
		<th><?php __('Customer Id'); ?></th>
		<th><?php __('Persona Fisica O Juridica'); ?></th>
		<th><?php __('Character Type Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($characterType['Character'] as $character):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $character['id'];?></td>
			<td><?php echo $character['porcentaje'];?></td>
			<td><?php echo $character['name'];?></td>
			<td><?php echo $character['calle'];?></td>
			<td><?php echo $character['numero_calle'];?></td>
			<td><?php echo $character['piso'];?></td>
			<td><?php echo $character['depto'];?></td>
			<td><?php echo $character['cp'];?></td>
			<td><?php echo $character['localidad'];?></td>
			<td><?php echo $character['departamento'];?></td>
			<td><?php echo $character['provincia'];?></td>
			<td><?php echo $character['identification_type_id'];?></td>
			<td><?php echo $character['identification_number'];?></td>
			<td><?php echo $character['nationality_type_id'];?></td>
			<td><?php echo $character['identification_authority'];?></td>
			<td><?php echo $character['fecha_nacimiento'];?></td>
			<td><?php echo $character['marital_status_id'];?></td>
			<td><?php echo $character['nupcia'];?></td>
			<td><?php echo $character['conyuge'];?></td>
			<td><?php echo $character['personeria_otorgada'];?></td>
			<td><?php echo $character['inscripcion'];?></td>
			<td><?php echo $character['fecha_inscripcion'];?></td>
			<td><?php echo $character['apoderado_name'];?></td>
			<td><?php echo $character['apoderado_identification_type_id'];?></td>
			<td><?php echo $character['apoderado_identification_number'];?></td>
			<td><?php echo $character['apoderado_nationality_type'];?></td>
			<td><?php echo $character['apoderado_identification_auth'];?></td>
			<td><?php echo $character['customer_id'];?></td>
			<td><?php echo $character['persona_fisica_o_juridica'];?></td>
			<td><?php echo $character['character_type_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'characters', 'action' => 'view', $character['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'characters', 'action' => 'edit', $character['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'characters', 'action' => 'delete', $character['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $character['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Character', true)), array('controller' => 'characters', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
