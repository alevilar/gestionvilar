<?
$formName;
$customer = empty($this->data['Vehicle']['Customer']['name'])?'':$this->data['Vehicle']['Customer']['name'];
$vehicle_id = $this->data['Vehicle']['id'];
?>
<h1>Formulario <?= "$formName"?> -- Dominio: <?= $this->data['Vehicle']['patente']?></h1>



<? //echo $this->element('vehicle_form_view', array('vehicle'=>$this->data['Vehicle']));?>


<div class="span-24 last">
    <?php
    echo $this->Form->create($formName, array(
    'url'=> "/field_creators/addForm/$formName/$vehicle_id",
    'id'=> 'form-'.$formName,
    ));

    echo $this->Form->button(__('Download PDF',true), array('id'=>'pdf', 'type'=>'submit'));

    if (!empty($this->data[$formName]['id'])) {
        echo $this->Form->input('id');
    }
    echo $this->Form->hidden('vehicle_id', array('value'=>$vehicle_id));

    ?>
    
    <div id="opciones-de-eleccion" class="clear span-24 last"><hr />
        <h3 class="letra-marron">1°) Seleccione los datos para llenar el formulario</h3>
        <?php
        foreach ($elements as $e=>$opt) {
            echo $this->element($e, $opt);
        }
        ?>
    </div>

    <hr class="spacer"/>
    <br />
    <h3 class="letra-marron">2°) Ingrese valores para el resto de los campos</h3>
</div>

<div class="span-12">
    <?php
    $i = 1;
    foreach($formInputs as $inputs) {
        if ($i % 2 != 0) {
            echo $this->Form->inputs($inputs);
        }
        $i++;
    }
    ?>
</div>

<div class="span-12 last">
    <?php
    $i = 1;
    foreach($formInputs as $inputs) {
        if ($i % 2 == 0) {
            echo $this->Form->inputs($inputs);
        }
        $i++;
    }
    ?>
</div>


<div class="clear">
    <?php echo $this->Form->button(__('PDF',true), array('id'=>'pdf', 'type'=>'submit'));?>
</div>
<?php echo $this->Form->end();?>



<script type="text/javascript">

    <?php
    // escribo el javascript pasado desde el controlador
    echo $writeJavascript
    ?>

    
    // Hago que se oculten los FIELDSET cuando les hago click
    $(function(){
        $('legend').click(function(){
            $(this).siblings().slideToggle();
        });
    });

</script>

