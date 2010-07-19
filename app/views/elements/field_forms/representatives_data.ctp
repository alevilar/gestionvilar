<?php

$random = rand(1, 989898);

if (empty($label)) {
    $label = 'Apoderado';
}
if (empty ($field)) {
    $field = 'representative_id';
}

// armo el JSON de Apoderados o Represetatives
if (empty($representatives)) {
    $representatives = $this->data['Vehicle']['Customer']['Representative'];

    $finalRepresentatives = array();
    foreach($representatives as $rp) {
        $finalRepresentatives[$rp['id']] = array(
                'text'=>$rp['name'],
                'json'=>json_encode($rp),
        );
    }
    $representatives = $finalRepresentatives;
}
?>

<div id="element-representative" class="span-5 element">
    <?php if (!empty($label)) {?>
    <label><?php echo $label?></label>
        <?php }?>
    <select name="<?php echo "data[$formName][$field]"?>" id="<?php echo 'FormRepresentativeId-'.$random?>">
        <option value="">Seleccione</option>
        <?php foreach ($representatives as $a=>$v) {?>
        <option class="opt-representatives" value="<?php echo $a?>" json='<?php echo $v['json']?>'><?php echo $v['text']?></option>
            <?php }?>
    </select>
</div>


<script type="text/javascript">
    $(document).ready(populateCampos);
    
    function populateCampos(){
        var seleccionado = $('#FormRepresentativeId-<?php echo $random ?>  option:selected');  

        if (seleccionado.val()){
            var Representative =  jQuery.parseJSON(seleccionado.attr('json'));
            for (property in Representative) {
                var inputName = "data[<?php echo $formName?>][representative_"+property+"]";
                $('[name="'+inputName+'"]').val(Representative[property]);
            }
        } else {
            var inputName = "data[<?php echo $formName?>][representative";
            $('input[name^="'+inputName+'"]').val('');
            $('select[name^="'+inputName+'"]').val('');
        }
    }

    $('#FormRepresentativeId-<?php echo $random ?>').change(populateCampos);
    
    
</script>
