<?php


echo $this->Form->input('spouse_id', array(
    'empty'=>'Seleccione',
    'default'=>'',
    'id'=> 'FormSpouseId',
    ));
?>

<div id="spouse-hide-link" class="btn-ocultar"><a href="javascript: ;" onclick="$('#spouse-data').toggle(); $('#spouse-hide-link').toggle()">Ocultar</a></div>

<div id="spouse-data" style="background: silver"></div>


<script type="text/javascript">
    $('#FormSpouseId').change(function(){
        var selectedRep = $('#FormSpouseId').val();
       if (selectedRep || selectedRep != '') {
          $('#spouse-data').load('<?= $this->Html->url('/spouses/edit/')?>'+selectedRep);
          $('#spouse-data').show();
          $("#spouse-hide-link").show();
       }
    });
</script>
