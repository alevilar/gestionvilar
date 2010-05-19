<?
$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
?>
<h1>Formulario 02 de <?= $customer?></h1>


<?php
echo $this->Form->create('F02');

if (!empty($this->data['F02']['id'])) {
    echo $this->Form->input('id');
}

echo $this->Form->input('type');

echo $this->Form->hidden('vehicle_id');

echo $this->Form->input('declaraciones', array('type'=>'textarea', 'rows'=>3));

echo $this->Form->input('solicitante', array('value'=>$customer));


echo $this->Form->input('representative_id', array('empty'=>'Seleccione','default'=>''));
?>
<div id="representative-data" style="background: silver"></div>

<div class="clear">
<?
$vehicle = $this->data['Vehicle']
?>
<h2>Vehículo</h2>
<dl>
    <dt>Dominio</dt>
    <dd><?= $vehicle['patente']?></dd>
    <dt>Marca</dt>
    <dd><?= $vehicle['brand']?></dd>
    <dt>Tipo</dt>
    <dd><?= $vehicle['type']?></dd>
    <dt>Modelo</dt>
    <dd><?= $vehicle['model']?></dd>
    <dt>Marca Motor</dt>
    <dd><?= $vehicle['motor_brand']?></dd>
    <dt>N° Motor</dt>
    <dd><?= $vehicle['motor_number']?></dd>
    <dt>Marca Chasis</dt>
    <dd><?= $vehicle['chasis_brand']?></dd>
    <dt>N° Chasis</dt>
    <dd><?= $vehicle['chasis_number']?></dd>
</dl>
</div>

<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>

<script type="text/javascript">
    $('#F02RepresentativeId').change(function(){
        var selectedRep = $('#F02RepresentativeId').val();
       if (selectedRep || selectedRep != '') {
          $('#representative-data').load('<?= $this->Html->url('/representatives/view/')?>'+selectedRep);
       }
    });
</script>