<?php

echo $this->Form->create('Alejandris');



$cosas = array(
    'Parte 1' => array(
        'default'=>'fuck you',
        'apellido',
        'telefono'
    ),
    'Parte 2' => array(
        'direccion',
       
    ),
    'fieldset'=>'un Fieldset'
);
echo $this->Form->inputs($cosas);


$cosas = array('mas cosas','otro mas','legend'=>'Una leyenda', );
echo $this->Form->inputs($cosas);


echo $this->Form->end('guardadita adentro');
