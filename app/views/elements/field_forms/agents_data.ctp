
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



    <div id="agent-hide-link-<?php echo $random ?>" class="btn-ocultar"><a href="javascript: ;">Ocultar</a></div>

    <div id="agent-data-<?php echo $random  ?>" style="background: silver"></div>

</div>

<script type="text/javascript">
    function populateCampos(){
        var seleccionado = $('#FormAgentId-<?php echo $random ?>  option:selected');
        if (seleccionado.val()){
            Agent = eval("(" +seleccionado.attr('json') +")");
            console.debug(Agent);

            $('#FormAgentId-<?php echo $random ?>').cakeFormFill(
            {
                '"data[F59m][mandatario_apellidos]"':Agent.surname,
                '"data[F59m][mandatario_nombre]"':Agent.first_name,
                '"data[F59m][mandatario_identification]"':Agent.identification_name +" "+Agent.identification_number,
                '"data[F59m][mandatario_domicilio]"':Agent.address,
                '"data[F59m][mandatario_domicilio_numero]"':Agent.address_number,
                '"data[F59m][mandatario_domicilio_piso]"':Agent.address_floor,
                '"data[F59m][mandatario_domicilio_dpto]"':Agent.address_apartment,
                '"data[F59m][mandatario_localidad]"':Agent.city,
                '"data[F59m][mandatario_provincia]"':Agent.state,
                '"data[F59m][mandatario_cp]"':Agent.postal_code,
                '"data[F59m][mandatario_matricula]"':Agent.license,
                '"data[F59m][mandatario_matricula_mandatario]"':Agent.super_license
            }
        );
        } else {
            $('#FormAgentId-<?php echo $random ?>').cakeFormFill(
            {
                '"data[F59m][mandatario_apellidos]"': '',
                '"data[F59m][mandatario_nombre]"': '',
                '"data[F59m][mandatario_identification]"': '',
                '"data[F59m][mandatario_domicilio]"': '',
                '"data[F59m][mandatario_domicilio_numero]"': '',
                '"data[F59m][mandatario_domicilio_piso]"': '',
                '"data[F59m][mandatario_domicilio_dpto]"': '',
                '"data[F59m][mandatario_localidad]"': '',
                '"data[F59m][mandatario_provincia]"': '',
                '"data[F59m][mandatario_cp]"': '',
                '"data[F59m][mandatario_matricula]"': '',
                '"data[F59m][mandatario_matricula_mandatario]"': ''
            });
        }
    }

    $('#FormAgentId-<?php echo $random ?>').change(populateCampos);
    $(document).ready(populateCampos)
</script>
