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
    function meterSpouse(){
        var modelName = '<?php echo 'Spouse' ?>';
        var formName = '<?php echo $formName?>';
        var prefix = 'spouse';
        var randomNumber = <?php echo $random?>;

        if (modelName && formName && randomNumber) {
            populateCampos(modelName,formName, prefix, randomNumber);
        }
    }

    $('#FormSpouseId-<?php echo $random ?>').change(meterSpouse);
    $(document).ready(meterSpouse)
</script>
