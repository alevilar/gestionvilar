<?php


echo $this->Form->input('character_id', array(
    'empty'=>'Seleccione',
    'default'=>'',
    'id'=> 'FormCharacterId',
    ));
?>

<div id="character-hide-link" class="btn-ocultar"><a href="javascript: ;" onclick="$('#character-data').toggle(); $('#character-hide-link').toggle()">Ocultar</a></div>

<div id="character-data" style="background: silver"></div>


<script type="text/javascript">
    $('#FormCharacterId').change(function(){
        var selectedRep = $('#FormCharacterId').val();
       if (selectedRep || selectedRep != '') {
          $('#character-data').load('<?= $this->Html->url('/characters/edit/')?>'+selectedRep);
          $('#character-data').show();
          $("#character-hide-link").show();
       }
    });
</script>
