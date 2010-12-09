
    <?php
    $random = rand(1, 989898);

    if (empty ($label)) {
        $label = __('Agent',true);
    }

    if (empty ($field)) {
        $field = 'agent_id';
    }
    ?>

<div id="element-agent" class="span-5 element">
    <?php if (!empty($label)) {?>
    <label><?php echo $label?></label>
    <?php }?>
    
    <select name="<?php echo "data[$formName][$field]"?>" id="<?php echo 'FormAgentId-'.$random?>">
        <option value="">Seleccione</option>
        <?php foreach ($agents as $a=>$v) {?>
        <option class="opt-agents" value="<?php echo $a?>" json='<?php echo $agentJsonData[$a]?>'><?php echo $v?></option>
            <?php }?>
    </select>
</div>

<script type="text/javascript">
    function populateCampos(){
        var seleccionado = $('#FormAgentId-<?php echo $random ?>  option:selected');
        if (seleccionado.val()){
            Agent = eval("(" +seleccionado.attr('json') +")");

            $('#FormAgentId-<?php echo $random ?>').cakeFormFill(
            {
                '"data[<?php echo $formName?>][mandatario_apellidos]"':Agent.surname,
                '"data[<?php echo $formName?>][mandatario_nombre]"':Agent.first_name,
                '"data[<?php echo $formName?>][mandatario_identification]"':Agent.identification_name +" "+Agent.identification_number,
                '"data[<?php echo $formName?>][mandatario_domicilio]"':Agent.address,
                '"data[<?php echo $formName?>][mandatario_domicilio_numero]"':Agent.address_number,
                '"data[<?php echo $formName?>][mandatario_domicilio_piso]"':Agent.address_floor,
                '"data[<?php echo $formName?>][mandatario_domicilio_dpto]"':Agent.address_apartment,
                '"data[<?php echo $formName?>][mandatario_localidad]"':Agent.city,
                '"data[<?php echo $formName?>][mandatario_provincia]"':Agent.state,
                '"data[<?php echo $formName?>][mandatario_cp]"':Agent.postal_code,
                '"data[<?php echo $formName?>][mandatario_matricula]"':Agent.license,
                '"data[<?php echo $formName?>][mandatario_matricula_mandatario]"':Agent.super_license
            }
        );
        } else {
            $('#FormAgentId-<?php echo $random ?>').cakeFormFill(
            {
                '"data[<?php echo $formName?>][mandatario_apellidos]"': '',
                '"data[<?php echo $formName?>][mandatario_nombre]"': '',
                '"data[<?php echo $formName?>][mandatario_identification]"': '',
                '"data[<?php echo $formName?>][mandatario_domicilio]"': '',
                '"data[<?php echo $formName?>][mandatario_domicilio_numero]"': '',
                '"data[<?php echo $formName?>][mandatario_domicilio_piso]"': '',
                '"data[<?php echo $formName?>][mandatario_domicilio_dpto]"': '',
                '"data[<?php echo $formName?>][mandatario_localidad]"': '',
                '"data[<?php echo $formName?>][mandatario_provincia]"': '',
                '"data[<?php echo $formName?>][mandatario_cp]"': '',
                '"data[<?php echo $formName?>][mandatario_matricula]"': '',
                '"data[<?php echo $formName?>][mandatario_matricula_mandatario]"': ''
            });
        }
    }

    $('#FormAgentId-<?php echo $random ?>').change(populateCampos);
    $(document).ready(populateCampos)
</script>
