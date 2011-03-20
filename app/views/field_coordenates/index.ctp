

<?php
echo $this->Html->script('jquery.jeditable.mini', false);
?>

<script type="text/javascript">
    $(document).ready(function() {
     $('.edit').editable('<?php echo $this->Html->url('/field_coordenates/update')?>', {
         submit: 'OK',
         submitdata: function(){
             return {
                 field: $(this).attr('field'),
                 field_coordenate_id: $(this).attr('field_coordenate_id')
             }
         }
     });


     $('.edit_field_types').editable('<?php echo $this->Html->url('/field_coordenates/update')?>', {
         data: function() {return $(this).attr('options_types')},
         type: 'select',
         submit: 'OK',
//         onEdit: function(){
//             console.debug(this);
//             console.debug($(this));
//         },
         submitdata: function(){
             return {
                 field: $(this).attr('field'),
                 field_coordenate_id: $(this).attr('field_coordenate_id'),
                 text: $(this).find('select :selected').text()
             }
         }
     });

 });
</script>

<div class="fieldCoordenates index span-24 last">
	<h2><?php __('Field Coordenates');?></h2>

<?
$paginator->options(array('url' => $this->passedArgs));


echo $this->Form->create('FieldCoordenate',array('url'=>'index'));
echo $this->Form->input('field_creator_id');
echo $this->Form->input('name');
echo $this->Form->end('Buscar');
?>
        <table cellpadding="0" cellspacing="0" class="span-24 last">
	<tr>
            <th><?php echo $this->Paginator->sort('character_type');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('page');?></th>
			<th><?php echo $this->Paginator->sort('field_type_id');?></th>
			<th><?php echo $this->Paginator->sort('x');?></th>
			<th><?php echo $this->Paginator->sort('y');?></th>
			<th><?php echo $this->Paginator->sort('w');?></th>
                        <th><?php echo $this->Paginator->sort('h');?></th>
                        <th><?php echo $this->Paginator->sort('Max Reng.','renglones_max');?></th>
			<th><?php echo $this->Paginator->sort('Font','font_size');?></th>
                        <th><?php echo $this->Paginator->sort('Campo Dato','related_field_table_select');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fieldCoordenates as $fieldCoordenate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

                $fId = $fieldCoordenate['FieldCoordenate']['id'];
	?>
	<tr<?php echo $class;?>>

                <td  class="edit_field_types" options_types='<?php print json_encode($character_types) ?>' field="character_type" field_coordenate_id="<?php echo $fId; ?>">
                        <?php echo $fieldCoordenate['FieldCoordenate']['character_type']?>
                </td>
		<td class="edit" field="name" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['name']; ?></td>
		<td class="edit" field=page" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['page']; ?></td>
		<td class="edit_field_types" options_types='<?php print json_encode($fieldTypes) ?>' field="field_type_id" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldType']['name'];?></td>
		<td class="edit" field="x" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['x']; ?></td>
		<td class="edit" field="y" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['y']; ?></td>
		<td class="edit" field="w" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['w']; ?></td>
                <td class="edit" field="h" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['h']; ?></td>
                <td class="edit" field="renglones_max" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['renglones_max']; ?></td>
		<td class="edit" field="font_size" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['font_size']; ?></td>
                <td title="<?php echo $fieldCoordenate['FieldCoordenate']['related_field_table'];?>">
                    <?php
                    if ($session->read('Auth.User.username') == 'alevilar') {
                        
                        ?>
                    <div style="background-color: silver" title="Related field table" class="edit" field="related_field_table" field_coordenate_id="<?php echo $fId; ?>"><?php echo $fieldCoordenate['FieldCoordenate']['related_field_table']; ?></div>
                    <div  style="background-color: pink" title="field Select" class="edit_field_types" options_types='<?php print json_encode($related_field_table_selects) ?>' field="related_field_table_select" field_coordenate_id="<?php echo $fId; ?>" title="<?php echo $fieldCoordenate['FieldCoordenate']['related_field_table_select']; ?>""><?php echo $fieldCoordenate['FieldCoordenate']['related_field_table_select']?></div>
                    <?php } else {
                      echo $fieldCoordenate['FieldCoordenate']['related_field_table_select'];
                    }
                    ?>
                </td>
		<td class="actions">
			<?php
                        if ($session->read('Auth.User.username') == 'alevilar')
                            echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fId));
                        ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fId), null, sprintf(__('Are you sure you want to delete # %s?', true), $fId)); ?>
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
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Coordenate', true)), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Types', true)), array('controller' => 'field_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Type', true)), array('controller' => 'field_types', 'action' => 'add')); ?> </li>
                <br>
                <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Type', true)), array('controller' => 'field_coordenates', 'action' => 'mapear')); ?> </li>
	</ul>
</div>