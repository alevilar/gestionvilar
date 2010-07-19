<?
$form_name = 'F03';

$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>
<h1>Formulario <?= "$form_name"?> -- Dominio: <?= $this->data['Vehicle']['patente']?></h1>



<? //echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>

<div class="span-12">
    <?php
    echo $this->Form->create($form_name, array('url'=> "/field_creators/addForm/$form_name/$vehicle_id"));
    if (!empty($this->data[$form_name]['id'])) {
        echo $this->Form->input('id');
    }
    echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));

    echo $this->element('field_forms/character_data', array('label'=>'Deudor'));


    ?>


    <fieldset>
        <legend>"A"</legend>
        <? echo $this->Jqform->date('a_fecha_contrato', array('label'=>'Fecha de celebración del contrato')); ?>
        <? echo $this->Form->input('a_monto_contrato', array('label'=>'Monto del contrato')); ?>
    </fieldset>


    <fieldset>
        <legend>"H"</legend>
        <? echo $this->Form->input('h_si',array('label'=>'Solicitud subscripta ante escribano público', 'options'=>array('No','Si'), 'empty'=>'Seleccione')); ?>
        <? echo $this->Form->input('h_lugar_y_fecha',array('label'=>'Lugar y Fecha'));?>
    </fieldset>

    <fieldset>
        <legend>"I"</legend>
        <? echo $this->Form->input('i_grado',array('label'=>'Grado'));?>
        <? echo $this->Form->input('i_clausula_actualizacion',array('label'=>'Clausula de actualización', 'options'=>array('No','Si'), 'empty'=>'Seleccione')); ?>
        <? echo $this->Form->input('i_concepto_prestamo',array('label'=>'Concepto', 'options'=>array('Préstamo','Saldo de Precio'), 'empty'=>'Seleccione')); ?>
    </fieldset>

    <fieldset>
        <legend>"J"</legend>
        <?php
        echo "CONSTE QUE EL CONTRATO FUE PRESENTADO para su inscrpción en este Registro Seccional de ";
        echo $this->Form->input('j_registro_seccional_de', array('label'=>false,'div'=>false));
        echo " el día ";
        echo $this->Form->input('j_dia', array('label'=>false,'div'=>false, 'style'=>'width: 40px'));
        echo " de ";
        echo $this->Form->input('j_mes', array('label'=>false,'div'=>false));
        echo " de 20";
        echo $this->Form->input('j_anio', array('label'=>false,'div'=>false, 'style'=>'width: 40px'));
        echo ".<br />";
        echo "Constando de original, con ";
        echo $this->Form->input('j_anexos', array('label'=>false,'div'=>false));
        echo "anexos y dos copias no negociables";
        ?>
    </fieldset>

    <fieldset>
        <legend>"K"</legend>
        <? echo $this->Form->input('k_lugar_y_dia', array('label'=>'Lugar y fecha')); ?>
        <? echo $this->Form->input('k_mes', array('label'=>'Mes')); ?>
        <? echo $this->Form->input('k_anio', array('label'=>'Año 20..', 'maxlenght'=>2)); ?>
    </fieldset>

    <fieldset class="span-12 last">
        <legend>"L"</legend>
        <? echo $this->Form->input('l_autorizo', array('label'=>'Autorizo a')); ?>
        <? echo $this->Form->input('l_doc', array('label'=>'Tipo y N° de documento')); ?>
    </fieldset>

    <fieldset class="span-12 last">
        <legend>"M"</legend>
        <?php

        echo "ENDOSO ";
        echo $this->Form->input('m_dia', array('label'=>false,'div'=>false));
        echo " de";
        echo $this->Form->input('m_mes', array('label'=>false,'div'=>false));
        echo " de 20";
        echo $this->Form->input('m_anio', array('label'=>false,'div'=>false, 'style'=>'width: 40px'));
        echo "<br />";
        echo "Págese a la orden de";
        echo $this->Form->input('m_a_la_orden', array('label'=>false,'div'=>false));
        echo "<br />Domiciliado en";
        echo $this->Form->input('m_domicilio', array('label'=>false,'div'=>false));
        echo "<br />calle";
        echo $this->Form->input('m_calle', array('label'=>false,'div'=>false));
        echo " N° ";
        echo $this->Form->input('m_numero', array('label'=>false,'div'=>false));

        echo "<br><br>";
        echo "REGISTRO DEL ENDOSO ";
        echo $this->Form->input('m_algo', array('label'=>false,'div'=>false));
        echo " de ";
        echo $this->Form->input('m_de', array('label'=>false,'div'=>false));
        echo " <br> Registrado el endoso de";
        echo $this->Form->input('m_endoso_de', array('label'=>false,'div'=>false));
        echo "<br />a favor de";
        echo $this->Form->input('m_favor_de', array('label'=>false,'div'=>false));
        echo "<br />al folio respectivo del Libro del Registro. ";
        echo $this->Form->input('m_folio', array('label'=>false,'div'=>false));
        ?>
    </fieldset>

    <fieldset class="span-12 last">
        <legend>"N"</legend>
        <?php
        echo "<br><br>";
        echo "CANCELACIÓN DEL CONTRATO <br />";
        echo "de ";
        echo $this->Form->input('n_contrato_mes', array('label'=>false,'div'=>false));
        echo " de 20";
        echo $this->Form->input('n_contrato_anio', array('label'=>false,'div'=>false));
        echo " Pagado en la fecha, cancélese en el Registro de Inscripción.<br /><br /><br />";

        echo "REGISTRO DE CANCELACIÓN: En la fecha se registró la cancelación del presente contrato, al folio respectivo del Libro del Registro.<br/>";
        echo $this->Form->input('n_cancela_dia', array('label'=>false,'div'=>false));
        echo " de ";
        echo $this->Form->input('n_cancela_mes', array('label'=>false,'div'=>false));
        echo " de 20";
        echo $this->Form->input('m_anio', array('label'=>false,'div'=>false, 'style'=>'width: 40px'));
        ?>
    </fieldset>

    <fieldset class="span-12 last">
        <legend>"O"</legend>
        <?php

        echo "TRASLADO: ";
        echo $this->Form->input('o_traslado', array('label'=>false,'div'=>false));
        echo "de ";
        echo $this->Form->input('o_de', array('label'=>false,'div'=>false));
        echo " de 20";
        echo $this->Form->input('o_anio', array('label'=>false,'div'=>false, 'style'=>'width: 40px'));
        echo "<br /> Se tomó nota en el folio respectivo del Libro del Registro, del traslado de los bienes a la siguiente ubicación:";
        echo $this->Form->input('o_ubicacion', array('label'=>false,'div'=>false));
        echo "<br />habiéndose efectuado la comunicación por la nota archivada bajo el N°:";
        echo $this->Form->input('o_numero', array('label'=>false,'div'=>false));
        ?>
    </fieldset>




    <?
    /*

vehicle_id
deudor_id





    */




    ?>



</div>


<div class="span-12 last">
    <fieldset class="span-12 last">
        <legend>"D" Identificación del Acreedor</legend>
        <? echo $this->element('customer_form_view', array('customer'=>$this->data['Vehicle']['Customer'])); ?>
    </fieldset>

    <fieldset class="span-12 last">
        <legend>"G" Identificación del automotor</legend>
        <? echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>
    </fieldset>
</div>


<?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
<?php echo $this->Form->end();?>

