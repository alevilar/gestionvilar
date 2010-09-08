
<h1>Formularios Históricos del Vehículo</h1>

<h2>Cliente: <?php echo $vehicle['Customer']['name']?></h2>

<h3>Datos Básicos del Vehículo</h3>
<dl>
    <dt>Dominio:</dt>
    <dd><?php echo $vehicle['Vehicle']['patente']?></dd>

    <dt>N° Chasis:</dt>
    <dd><?php echo $vehicle['Vehicle']['chasis_number']?></dd>

    <dt>Marca:</dt>
    <dd><?php echo $vehicle['Vehicle']['brand']?></dd>

    <dt>Modelo:</dt>
    <dd><?php echo $vehicle['Vehicle']['model']?></dd>
</dl>


<h3>Formularios Generados</h3>
<?php
$cant = 0;
foreach ($vehicleForms as $name=>$mas) {
    if (!empty($mas)) {
        echo "<p><b>$name:</b> ";
        foreach($mas as $form) {
            echo $html->link(date('d/m/Y h:m A',strtotime($form[$name]['created'])), "/field_creators/generar_pdf/".$printer['Printer']['id']."/$name/".$form[$name]['id'].".pdf");
            echo " ----  ";
            $cant++;
        }
        echo "</p><hr />";
    }
}

if ($cant == 0) {
    echo "<p style='color:red; font-size: 12pt;'><b>¡¡ El vehículo aún no tiene formularios impresos !!</b></p>";
}
