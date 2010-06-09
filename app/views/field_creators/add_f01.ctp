<?
$form_name = 'F01';

$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
debug($vehicle_id);
?>
<h1>Formulario <?= "$form_name de $customer"?> -- Dominio: <?= $this->data['Vehicle']['patente']?></h1>


<? //echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>

<?php
echo $this->Form->create($form_name, array('url'=> "/field_creators/addForm/$form_name/$vehicle_id"));

if (!empty($this->data[$form_name]['id'])) {
    echo $this->Form->input('id');
}

echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));

?>

<?
if (count($spouses) == 1) {
    $val = each($spouses);
    echo $this->Form->hidden('spouse_id', array(
                    'value'=>array('value'=> $val['key'])));
    echo "<h2>".__('Customer´ Spouse',true).$val['value']."</h2>";
} elseif (count($spouses) > 1) {
    echo $this->Form->input('spouse_id', array('options'=>$spouses, 'empty'=>'Seleccione'));
}

if (count($condominia) == 1) {
    $val = each($condominia);
    echo $this->Form->hidden('condominium_id', array(
                    'value'=>array('value'=> $val['key'])));
    echo "<h2>".__('Customer´s Condominium',true).": ".$val['value']."</h2>";
} elseif (count($condominia) > 1) {
    echo $this->Form->input('condominium_id', array('options'=>$condominia, 'empty'=>'Seleccione'));
}

if (count($representatives) == 1) {
    $val = each($representatives);
    echo $this->Form->hidden('representative_id', array(
                    'value'=>array('value'=> $val['key'])));
    echo "<h2>".__('Customer´s representatives',true).": ".$val['value']."</h2>";
} elseif (count($representatives) > 1) {
    echo $this->Form->input('representative_id', array('options'=>$representatives, 'empty'=>'Seleccione'));
}


?>

<? echo $this->element('customer_form_view', array('customer'=>$this->data['Vehicle']['Customer'])); ?>
<? echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle'])); ?>



<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>

