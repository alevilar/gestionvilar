<?php
$random = rand(1, 989898);

if (empty ($label)){
    $label = __('Character',true);
}

if (empty ($field)){
    $field = 'character_id';
}
if (empty ($field_prefix)) {
    $field_prefix = 'character';
}

// armo el JSON de Apoderados o Represetatives
if (empty($characters)) {
    $characters = $this->data['Vehicle']['Customer']['Character'];

    $finalCharacters = array();
    foreach($characters as $rp) {
        $finalCharacters[$rp['id']] = array(
                'text'=>$rp['name'],
                'json'=>json_encode($rp),
        );
    }
    $characters = $finalCharacters;
}
?>

<div id="element-character" class="span-5 element">
    <?php if (!empty($label)) {?>
    <label><?php echo $label?></label>
        <?php }?>
    <select name="<?php echo "data[$formName][$field]"?>" id="<?php echo 'FormCharacterId-'.$random?>">
        <option value="">Seleccione</option>
        <?php foreach ($characters as $a=>$v) {?>
        <option class="opt-characters" value="<?php echo $a?>" json='<?php echo $v['json']?>'><?php echo $v['text']?></option>
            <?php }?>
    </select>
</div>


<script type="text/javascript">
    $(document).ready(populateCamposCharacter);
    $('#FormCharacterId-<?php echo $random ?>').change(populateCamposCharacter);

    function populateCamposCharacter(){
        var seleccionado = $('#FormCharacterId-<?php echo $random ?>  option:selected');

        if (seleccionado.val()){
            var Representative =  jQuery.parseJSON(seleccionado.attr('json'));
            for (property in Representative) {
                var inputName = "data[<?php echo $formName?>][<?php echo $field_prefix?>_"+property+"]";
                $('[name="'+inputName+'"]').val(Representative[property]);
            }
        } else {
            var inputName = "data[<?php echo $formName?>][<?php echo $field_prefix?>";
            $('input[name^="'+inputName+'"]').val('');
            $('select[name^="'+inputName+'"]').val('');
        }
    }
</script>
