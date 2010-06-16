<?php
$random = rand(1, 989898);

if (empty ($label)){
    $label = __('Character',true);
}

if (empty ($field)){
    $field = 'character_id';
}

echo $this->Form->input($field, array(
    'empty'=>'Seleccione',
    'default'=>'',
    'id'=> 'FormCharacterId-'.$random ,
    'label'=>$label,
    'options'=>$characters,
    ));
?>

<div id="character-hide-link-<?php echo $random ?>" class="btn-ocultar"><a href="javascript: ;">Ocultar</a></div>

<div id="character-data-<?php echo $random  ?>" style="background: silver"></div>


<script type="text/javascript">
    $('#character-hide-link-<?php echo $random ?>').click(function(){
        $('#character-data-<?php echo $random ?>').toggle();
        $('#character-hide-link-<?php echo $random ?>').toggle()
    });

    $('#FormCharacterId-<?php echo $random ?>').change(function(){
        var selectedRep = $(this).val();
       if (selectedRep || selectedRep != '') {
          $('#character-data-<?php echo $random ?>').load('<?= $this->Html->url('/characters/edit/')?>'+selectedRep);
          $('#character-data-<?php echo $random ?>').show();
          $("#character-hide-link-<?php echo $random ?>").show();
       }
    });
</script>
