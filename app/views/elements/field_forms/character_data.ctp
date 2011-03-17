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

if (empty($formName)) {
    $formName = 'FormNoName';
}

// armo el JSON de Apoderados o Represetatives
if (empty($characters)) {
    if (!empty($this->data['Vehicle']['Customer']['Character'])) {
        $characters = $this->data['Vehicle']['Customer']['Character'];
    } elseif (!empty($this->data['Customer']['Character'])) {
        $characters = $this->data['Vehicle']['Customer']['Character'];
    } else {
        return '';
    }

    foreach ($characters as &$ch) {
        $ch['porcentaje'] = $ch['porcentaje']. "  00";

        if (!empty($ch['fecha_nacimiento'])) {
            $ch['fecha_nacimiento'] = date('d-m-y',strtotime($ch['fecha_nacimiento']));
            $ch['anio_nacimiento'] = date('y',strtotime($ch['fecha_nacimiento'])) ;
            $ch['mes_nacimiento']  = date('m',strtotime($ch['fecha_nacimiento']));
            $ch['dia_nacimiento']  = date('d',strtotime($ch['fecha_nacimiento'])) ;
        }

        if (!empty($ch['fecha_inscripcion'])) {
            $ch['fecha_inscripcion'] = date('d-m-y',strtotime($ch['fecha_inscripcion']));
            $ch['anio_inscripcion'] = date('y',strtotime($ch['fecha_inscripcion'])) ;
            $ch['mes_inscripcion']  = date('m',strtotime($ch['fecha_inscripcion'])) ;
            $ch['dia_inscripcion']  = date('d',strtotime($ch['fecha_inscripcion'])) ;
        }
    }
    
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

<div id="element-character-<?php echo $random?>" class="span-5 element">
    <?php if (!empty($label)) {?>
    <label><?php echo $label?></label>
        <?php }?>
    <select name="<?php echo "data[$formName][$field]"?>" id="<?php echo 'FormCharacterId-'.$random?>" class="span-5">
        <option value="">Seleccione</option>
        <?php foreach ($characters as $a=>$v) {?>
        <option class="opt-characters" value="<?php echo $a?>" json='<?php echo $v['json']?>'><?php echo $v['text']?></option>
            <?php }?>
    </select>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        populateCampos(<?php echo "'Character','$formName','$field_prefix',$random"?>);
    });
    $('<?php echo "#FormCharacterId-$random" ?>').change(function(){
        populateCampos(<?php echo "'Character','$formName','$field_prefix',$random"?>);
    }
    );
</script>