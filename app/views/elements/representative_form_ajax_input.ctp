<?php

echo $this->Form->input('representative_id', array(
    'empty'=>'Seleccione',
    'default'=>'',
    'id'=> 'FormRepresentativeId',
    ));
?>
<div id="representative-data" style="background: silver"></div>


<script type="text/javascript">
    $('#FormRepresentativeId').change(function(){
        var selectedRep = $('#FormRepresentativeId').val();
       if (selectedRep || selectedRep != '') {
          $('#representative-data').load('<?= $this->Html->url('/representatives/view/')?>'+selectedRep);
       }
    });
</script>