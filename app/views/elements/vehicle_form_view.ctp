

<div class="clear">
<h2>Vehículo</h2>
<? echo $html->link('editar','/vehicles/edit/'.$vehicle['id']);?>

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
