<?
$formName;
$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>

<style>
    LEGEND{
        cursor: pointer;
    }
</style>

<div class="span-12">
    <h3><?php echo empty($this->data['Vehicle']['notes'])?'Sin ':''?>Notas sobre el <?php echo $html->link('Vehículo', '/vehicles/edit/'.$this->data['Vehicle']['id'])?></h3>
    <p>
        <?php
        echo $this->data['Vehicle']['notes']
                ?>
    </p>
</div>

<div class="span-12 last">
    <h3><?php echo empty($this->data['Vehicle']['Customer']['notes'])?'Sin ':''?>Notas sobre el <?php echo $html->link('Cliente', '/customers/view/'.$this->data['Vehicle']['Customer']['id'])?></h3>
    <p>
        <?php
        if (!empty($this->data['Vehicle']['Customer']['CustomerNatural']['ocupation']))
            echo "<b>Ocupación:</b> ".$this->data['Vehicle']['Customer']['CustomerNatural']['ocupation']."<br />";
        echo $this->data['Vehicle']['Customer']['notes']
        ?>
    </p>
</div>
<div class="clear"></div>
<hr />
<h1>Formulario <?= "$formName"?> -- Dominio: <?= $this->data['Vehicle']['patente']?></h1>



<? //echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>
<div class="span-24 last">
<?php
    echo $this->Form->create($formName, array(
    'url'=> "/field_creators/addForm/$formName/$vehicle_id",
    'id'=> 'form-'.$formName,
    ));

    echo $this->Form->button(__('Download PDF',true), array('id'=>'pdf', 'type'=>'submit'));
    echo $this->Form->button(__('Reset', true), array('type'=>'reset'));

    echo $this->Form->input('printer_id', array(
    'label'=>array('text'=>'Impresora a utilizar', 'class'=>'span-3 prepend-1'),
    'after'=>$this->Html->link('¿Desea configurar otra impresora?','/printers/add',array('escape'=>false)),
    )
    );


//    if (!empty($this->data[$formName]['id'])) {
//        echo $this->Form->input('id');
//    }
    echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));

    ?>

    <?php if (count($elements)>0) {?>
    <div id="opciones-de-eleccion" class="clear span-24 last"><hr />
        <h3 class="letra-marron">Seleccione los datos dinámicos que desea agregar</h3>
            <?php

            foreach ($elements as $e=>$opt) {
                if (is_numeric($e)) {
                    $els = array_keys($opt);
                    $e = $els[0];
                    $opt = $opt[$e];
                }
                echo $this->element($e, $opt);
            }
            ?>
    </div>
        <?php }?>

    <hr class="spacer"/>
    <br />
    <h3 class="letra-marron">Formulario</h3>


<?php
$i = 1;
foreach($formInputs as $inputs) {
    $last = ($i % 2 != 0) ? '': 'last';

     $spanN = 'span-12';
    if (!empty($inputs['ocupa-todoel-ancho'])) {
        $spanN = 'span-24';
        unset ($inputs['ocupa-todoel-ancho']);
    }

    echo "<div class='$spanN $last'>";
    echo $this->Form->inputs($inputs,$formBlackList);
    echo "</div>";

    $i++;
}
?>

<div class="clear">
    <?php echo $this->Form->button(__('Download PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
</div>
<?php echo $this->Form->end();?>

</div>

<script type="text/javascript">
    mostrando = true;
<?php
// escribo el javascript pasado desde el controlador
$this->Js->buffer($writeJavascript);
?>

    $(document).ready(function(){
      $(":input[type=reset]").click(function(){
        
       $('form').resetForm();
       $('form').clearForm();
       
      })
    });

    // Hago que se oculten los FIELDSET cuando les hago click
    $(function(){
        $('legend').click(function(){
            if (mostrando) {
                $(this).siblings().slideUp();
                mostrando = false;
            } else {
                $(this).siblings().slideDown();
                mostrando = true;
            }

        });
    });


</script>

