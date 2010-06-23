<?
$form_name = 'F08';

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

    ?>
    <fieldset>
        <legend>"E"</legend>
        <?
        echo $this->element('field_forms/character_data', array('label'=>'Condominio en la compra'));
        ?>
    </fieldset>

    <fieldset>
        <legend>"I"</legend>
        <?
        echo $this->Form->input('i_fecha_sello', array('label'=>'Fecha, firma y sello del certificante'));
        echo $this->element('field_forms/character_data', array('label'=>'Vendedor', 'field'=>'vendedor_id'));
        ?>
    </fieldset>

    <fieldset>
        <legend>"J"</legend>
        <?
        echo $this->Form->input('j_fecha_sello', array('label'=>'Fecha, firma y sello del certificante'));
        echo $this->element('field_forms/character_data', array('label'=>'Condominio en la Venta', 'field'=>'vendedor_condominium_id'));


        ?>
    </fieldset>


    <fieldset>
        <legend>"A"</legend>
        <? echo $this->Form->input('a_lugar_contrato', array('label'=>'Lugar y fecha de celebración del contrato')); ?>
        <? echo $this->Form->input('a_precio_compra', array('label'=>'Precio de compra')); ?>
    </fieldset>


    <fieldset>
        <legend>"H"</legend>
        <table>
            <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Importe</td>
                    <td>Acreedor</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><? echo $this->Form->input('h1_fecha',array('label'=>false, 'style'=>'width: 100px')); ?></td>
                    <td><? echo $this->Form->input('h1_importe',array('label'=>false, 'style'=>'width: 100px')); ?></td>
                    <td><? echo $this->Form->input('h1_acreedor',array('label'=>false)); ?></td>
                </tr>
                <tr>
                    <td><? echo $this->Form->input('h2_fecha',array('label'=>false, 'style'=>'width: 100px')); ?></td>
                    <td><? echo $this->Form->input('h2_importe',array('label'=>false, 'style'=>'width: 100px')); ?></td>
                    <td><? echo $this->Form->input('h2_acreedor',array('label'=>false)); ?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>"M"</legend>
        <? echo $this->Form->input('observaciones');?>
    </fieldset>

    <fieldset>
        <legend>"O"</legend>
        <?php
        echo "Autorizo a";
        echo $this->Form->input('o_autorizado_name', array('label'=>false,'div'=>false));
        echo " tipo de documento y n° ";
        echo $this->Form->input('o_tipo_y_num_doc', array('label'=>false,'div'=>false));

        echo "<br>Recibí título y cédula de identificación ";
        echo $this->Form->input('o_recibi_tit', array('label'=>false,'div'=>false));

        ?>
    </fieldset>
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

