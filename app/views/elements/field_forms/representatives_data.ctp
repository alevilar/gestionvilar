<?php

$random = rand(1, 989898);

if (empty($label)) {
    $label = 'Apoderado';
}
if (empty ($field)) {
    $field = 'representative_id';
}
if (empty ($field_prefix)) {
    $field_prefix = 'representative';
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
    $(document).ready(function(){
        populateCampos(<?php echo "'Representative','$formName','$field_prefix',$random"?>);
    });
    $('<?php echo "#FormRepresentativeId-$random" ?>').change(function(){
        populateCampos(<?php echo "'Representative','$formName','$field_prefix',$random"?>);
    }
    );
</script>