<?php


echo $this->Form->input('condominium_id', array(
    'empty'=>'Seleccione',
    'default'=>'',
    'id'=> 'FormCondominiumId',
    ));
?>

<div id="condominium-hide-link" class="btn-ocultar"><a href="javascript: ;" onclick="$('#condominium-data').toggle(); $('#condominium-hide-link').toggle()">Ocultar</a></div>

<div id="condominium-data" style="background: silver"></div>


<script type="text/javascript">
    $('#FormCondominiumId').change(function(){
        var selectedRep = $('#FormCondominiumId').val();
       if (selectedRep || selectedRep != '') {
          $('#condominium-data').load('<?= $this->Html->url('/condominia/edit/')?>'+selectedRep);
          $('#condominium-data').show();
          $("#condominium-hide-link").show();
       }
    });
</script>
