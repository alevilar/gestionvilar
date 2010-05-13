<?
/* @var $this View */
?>

<div class="box">
    <?= $this->Html->image('user.png', array('height'=>'40px', 'class'=>'pull-1'));?>
    <div class="span-8">
        <h2 class="center">
            <? echo $customer['Customer']['name']?>
        </h2>
    </div>
    <div class="span-5 last">
        <? echo $this->Html->link('Editar Cliente', '/customers/edit/'.$customer['Customer']['id'])?>
        <? echo $this->Html->link('Agregar Vehiculo', '/vehicles/add/'.$customer['Customer']['id'])?>
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

</div>