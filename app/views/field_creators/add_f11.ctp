<?
$form_name = 'F11';

$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>
<h1>Formulario 11 de <?= $customer?> -- Dominio: <? $this->data['Vehicle']['patente']?></h1>


<? //echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>

<?php
echo $this->Form->create($form_name, array('url'=> "/field_creators/addForm/$form_name/$vehicle_id"));

if (!empty($this->data[$form_name]['id'])) {
    echo $this->Form->input('id');
}

echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));

?>

<div class="span-10">
    <? echo $this->Form->input('datos');?>

    <?
    $entregas = array('posesion'=>'Entrega de Posesión', 'tenencia'=>'Entrega de Tenencia');
    echo $this->Form->input('tipo_entrega', array('options'=>$entregas, 'empty'=>'Seleccione'));?>
</div>


<div class="span-14 last">
    <b>Si elige un Apoderado, los datos que se imprimiran serán de éste, y no los del vendedor</b>
    <?
    
        echo $this->element('representative_form_ajax_input');
    
        echo $this->element('customer_form_view', array('customer'=>$this->data['Vehicle']['Customer']));   
    ?>
    <p>El cónyuge dado de alta en el sistema, para este formulario seria el "Apoderado del cónyuge". Entonces, restaria escribir el nombre del cónyuge:</p>
    <?
    echo $this->element('spouse_form_ajax_input');
    
    echo $this->Form->input('nombre_del_conyuge');
    ?>
</div>



<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>