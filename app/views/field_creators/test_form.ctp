
<h1>Prueba de impresión de cada formulario</h1>

<p>
    Luego de elegir un formulario y una impresora, se generará un PDF.
    La idea de esto espoder visualizar cada uno delos campos a imprmir.
    De esa forma se poodrá comprobar la correctam impresión de cadauno de ellos.
</p>
<?php

echo $this->Form->create('FieldCreator');
echo $this->Form->input('form_id');
echo $this->Form->input('printer_id');
echo $this->Form->input('debug', array('type'=>'checkbox', 'label'=>'Mostrar recuadros generados', 'default'=>true));
echo $this->Form->end('Generar PDF');
?>
