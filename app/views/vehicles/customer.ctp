<?
/* @var $this View */
?>
<div class="span-13 column-header">
    <?= $this->Html->image('user.png', array('height'=>'40px', 'style'=>'float:left'));?>

    <h2 class="center span-9">
        <? echo $customer['Customer']['name']?>
    </h2>

    <div class="span-3 last">
        <? echo $this->Html->link('Editar Cliente', '/customers/edit/'.$customer['Customer']['id'])?>
        <br>
        <? echo $this->Html->link('Agregar Vehiculo', '/vehicles/add/'.$customer['Customer']['id'])?>
    </div>
</div>


<? echo $this->element('vehicles_from_customer', $vehicles);?>

<?
if (count($vehicles) == 0) {
    echo "<div class='notice span-12 last'>"
            .__('This customer has no vehicles',true)
            ." "
            .$this->Html->link('haga click aquí para agregar uno','/vehicles/add/'.$customer['Customer']['id'])
            ."</div>";
}
?>
