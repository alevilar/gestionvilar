<div class="column span-15 last"  id="div-for-vehicles" >
    <?php
    if (empty($customer)) {
    ?>
        <div id="vehicle-list-header" class="column-header">
<?= $this->Html->image('playlist.png', array('height' => '40px', 'style' => 'float:left')); ?>
            <h2 class="center"><? __('Vehicle´s List') ?></h2>
    </div>
<?php } else { ?>
    <div id="vehicle-header-customer" class="span-13 column-header"">
<?= $this->Html->image('user.png', array('height' => '40px', 'style' => 'float:left')); ?>
             <h2 id="vehicle-customer-title" class="center span-9">
<?php echo $customer['name'] ?>
            </h2>
            <div class="span-3 last">
<? echo $this->Html->link('Más Info Cliente', '/customers/view/' . $customer['id'], array('id' => 'btn-cliente-view')) ?>
            <br>
<? echo $this->Html->link('Agregar Vehiculo', '/vehicles/add/' . $customer['id'], array('id' => 'btn-add-vehicle')) ?>
        </div>
    </div>
<?php } ?>



    <div id="vehicle-list" class="search-content span-15 last">
        <span style="float: right">
<?php

    $this->Paginator->options(array(
        'update' => '#div-for-vehicles',
        'model' => 'Vehicle',
        'url' => array(
            'controller' => 'vehicles',
            'action' => 'search',
            ) +$this->passedArgs + array('redirect' => 'VehicleIndex'),
    ));


    echo $this->Paginator->counter(array('format' => 'Página %page% de %pages%. Total: %count% Vehículos', 'model'=>'Vehicle'));
    echo $this->Paginator->prev('« Anterior ', array('model'=>'Vehicle'), null, array('class' => 'disabled'));
    // echo $this->Paginator->numbers();
    echo $this->Paginator->next(' Siguiente »', array('model'=>'Vehicle'), null, array('class' => 'disabled'));
?>
        </span>

        <ul class="simple-list">
<?php
    $i = 0;
    foreach ($vehicles as $v):
        if (empty($v['Vehicle']))
            continue;
?>
            <li class='hover-highlight span-15 last'>
                <span class="span-1">
                    <?
                    $vehicle_type_id = 0;
                    if (!empty($v['Vehicle']['VehicleType']['id'])) {
                        $vehicle_type_id = $v['Vehicle']['VehicleType']['id'];
                    } elseif (!empty($v['VehicleType']['id'])) {
                        $vehicle_type_id = $v['VehicleType']['id'];
                    }
                    switch ($vehicle_type_id) {
                        case 1 : // es Moto
                            $img = 'motorcycle.gif';
                            break;
                        case 2 : // es auto
                            $img = 'car.gif';
                            break;
                        case 3 : // es maquinaria
                            $img = 'truck.gif';
                            break;
                        default:
                            $img = 'cake.icon.png';
                            break;
                    }
                    echo $this->Html->image($img, array('class' => 'span-1 last', 'style' => 'margin-top: 7px'));
                    ?>
                </span>
                <?
                    $vehicleName = "[" . $v['Vehicle']['patente'] . "] " . $v['Vehicle']['brand'] . " " . $v['Vehicle']['type'] . " " . $v['Vehicle']['model'];
                    $vehicleName .= ( $this->action == 'search') ? ' - ' . $v['Customer']['name'] : '';
                ?>
                    <span class="span-11">
                    <?=
                    $this->Html->link($vehicleName, 'javascript: ;', array(
                        'class' => 'alto3em',
                        'onclick' => 'seleccionarFormulario(' . $v['Vehicle']['id'] . ')',
                    ));
                    ?>
                </span>
                <span class="span-3 last">
                    <?
                    $pdfImg = $this->Html->image('pdf.png', array(
                                'title' => __('Print', true) . " $vehicleName",
                                'alt' => __('Print', true) . " $vehicleName",
                                'class' => 'span-1',
                            ));
                    echo $this->Html->link($pdfImg, 'javascript: ;', array(
                        'escape' => false,
                        'class' => 'images-link-1',
                        'onclick' => 'seleccionarFormulario(' . $v['Vehicle']['id'] . ')',
                    ));

                    $editImg = $this->Html->image('edit.png', array(
                                'title' => __('Edit', true) . " $vehicleName",
                                'alt' => __('Edit', true) . " $vehicleName",
                                'class' => 'span-1 last',
                            ));
                    echo $this->Html->link($editImg, '/vehicles/edit/' . $v['Vehicle']['id'], array(
                        'escape' => false,
                        'class' => 'images-link-1'));

                    $editHist = $this->Html->image('clock.png', array(
                                'title' => __('Historical Forms', true),
                                'alt' => __('Historical Forms', true),
                                'class' => 'span-1 last',
                            ));
                    echo $this->Html->link($editHist, '/vehicles/index_forms/' . $v['Vehicle']['id'], array(
                        'escape' => false,
                        'class' => 'last images-link-1'));
                    ?>
                    </span>
            <?php echo $this->element('vehicle_avaliable_forms', array('vehicleName' => $vehicleName, 'v' => $v)); ?>
                    </li><?
                    endforeach;
            ?>
                </ul>
            </div>


    <?
                    echo $this->Js->writeBuffer();
    ?>
</div>

<script type="text/javascript">
    function seleccionarFormulario(vehicle_id){
        $.blockUI({
            message: $('#formulario-de-'+vehicle_id),
            overlayCSS:  {
                backgroundColor: '#000',
                opacity:         0.6
            }
        });


        $('.blockOverlay').attr('title','Click para cerrar ventana').click($.unblockUI);



        setTimeout($.unblockUI, 10000);
        return false;
    }
</script>