<?php
$random = rand(1, 989898);

if (empty ($label)){
    $label = __('Agent',true);
}

if (empty ($field)){
    $field = 'agent_id';
}

echo $this->Form->input($field, array(
    'empty'=>'Seleccione',
    'default'=>'',
    'id'=> 'FormAgentId-'.$random ,
    'label'=>$label,
    'options'=>$agents,
    ));
?>

<div id="agent-hide-link-<?php echo $random ?>" class="btn-ocultar"><a href="javascript: ;">Ocultar</a></div>

<div id="agent-data-<?php echo $random  ?>" style="background: silver"></div>


<script type="text/javascript">
    $('#agent-hide-link-<?php echo $random ?>').click(function(){
        $('#agent-data-<?php echo $random ?>').toggle();
        $('#agent-hide-link-<?php echo $random ?>').toggle()
    });

    $('#FormAgentId-<?php echo $random ?>').change(function(){
        var selectedRep = $(this).val();
       if (selectedRep || selectedRep != '') {
          $('#agent-data-<?php echo $random ?>').load('<?= $this->Html->url('/agents/edit/')?>'+selectedRep);
          $('#agent-data-<?php echo $random ?>').show();
          $("#agent-hide-link-<?php echo $random ?>").show();
       }
    });
</script>
