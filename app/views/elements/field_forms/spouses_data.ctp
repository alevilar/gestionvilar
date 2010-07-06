<?php

$random = rand(1, 989898);

if (empty($label)){
    $label = 'Cónyuge';
}
if (empty ($field)) {
        $field = 'spouse_id';
}
?>


<div id="element-spouse" class="span-5 element">
    <?php if (!empty($label)) {?>
    <label><?php echo $label?></label>
    <?php }?>

    <select name="<?php echo "data[$formName][$field]"?>" id="<?php echo 'FormSpouseId-'.$random?>">
        <option value="">Seleccione</option>
        <?php foreach ($spouses as $a=>$v) {?>
        <option class="opt-spouses" value="<?php echo $a?>" json='<?php echo $v['json']?>'><?php echo $v['text']?></option>
            <?php }?>
    </select>
</div>


<script type="text/javascript">
    function populateCampos(){
        var seleccionado = $('#FormSpouseId-<?php echo $random ?>  option:selected');
        
        if (seleccionado.val()){
            Spouse = eval("(" +seleccionado.attr('json') +")");

            $('#FormSpouseId-<?php echo $random ?>').cakeFormFill(
            {
                '"data[<?php echo $formName?>][spouse_name]"':Spouse.name,
                '"data[<?php echo $formName?>][spouse_identification_type_id]"':Spouse.identification_type_id,
                '"data[<?php echo $formName?>][spouse_identification_number]"':Spouse.identification_number,
                '"data[<?php echo $formName?>][spouse_identification_autority]"':Spouse.identification_autority
            }
        );
        } else {
            $('#FormSpouseId-<?php echo $random ?>').cakeFormFill(
            {
                '"data[<?php echo $formName?>][spouse_name]"': '',
                '"data[<?php echo $formName?>][spouse_identification_type_id]"': '',
                '"data[<?php echo $formName?>][spouse_identification_number]"': '',
                '"data[<?php echo $formName?>][spouse_identification_autority]"': ''
            });
        }
    }

    $('#FormSpouseId-<?php echo $random ?>').change(populateCampos);
    $(document).ready(populateCampos)
</script>
