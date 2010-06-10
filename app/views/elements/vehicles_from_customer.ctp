<div class="search-content span-14 last" id="vehicle-list">
    <span style="float: right">
        <?php
        $this->Paginator->options(array('update' => '#vehicle-list'));
        echo $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
        // echo $this->Paginator->numbers();
        echo $this->Paginator->next(' Siguiente »', null, null, array('class' => 'disabled'));
        ?>
    </span>
    <span style="float: right"><a href="#" onclick="$('#vehicle-search').toggle();">Buscador</a></span>
    <div class="column span-14 last" id="vehicle-search" style="display:none">
        <?= $this->Form->create('Vehicle', array('url'=>'/vehicles/search'));?>
        <?= $this->Form->input('Customer.name', array('label'=>'Cliente', 'div'=>array('class'=>'span-4'),'class'=>'span-4'));?>
        <?= $this->Form->input('patente', array('label'=>'N° Dominio', 'div'=>array('class'=>'span-2'),'class'=>'span-2'));?>
        <?= $this->Form->input('chasis_number', array('label'=>'N° Chasis', 'div'=>array('class'=>'span-3'),'class'=>'span-3'));?>
        <? //= $this->Js->submit('Buscar',array('update'=>'vehicle-list','div'=>array('class'=>'span-2 last prepend-top'),'class'=>'span-2 last'));?>
        <?= $this->Form->end('Buscar',array('div'=>array('class'=>'span-2 last prepend-top'),'class'=>'span-2 last'));?>
    </div>

    <ul class="simple-list">
        <?php
        $i = 0;
        foreach ($vehicles as $v):
            ?>
        <li class='hover-highlight span-14 last'>
            <span class="span-1">
                    <?
                    switch ($v['VehicleType']['id']) {
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
                    echo $this->Html->image($img, array('class'=>'span-1 last', 'style'=>'margin-top: 7px'));
                    ?>
            </span>
                <?
                $vehicleName = "[".$v['Vehicle']['patente']."] ".$v['Vehicle']['brand']." ".$v['Vehicle']['type']." ".$v['Vehicle']['model'];
                $vehicleName .= ($this->action=='search')?' - '.$v['Customer']['name']:'';
                ?>
            <span class="span-11">
                    <?= $this->Html->link($vehicleName,'javascript: ;', array(
                            'class'=>'alto3em',
                            'onclick'=>'seleccionarFormulario('. $v['Vehicle']['id'] .')',
                    ));?>
            </span>
            <span class="span-2 last">
                    <?
                    $pdfImg = $this->Html->image('pdf.png',array(
                            'title'=>__('Print',true)." $vehicleName",
                            'alt'=>__('Print',true)." $vehicleName",
                            'class'=>'span-1',
                    ));
                    echo $this->Html->link($pdfImg, 'javascript: ;', array(
                    'escape'=>false,
                    'class'=>'span-1  images-link-1',
                    'onclick'=>'seleccionarFormulario('. $v['Vehicle']['id'] .')',
                    ));

                    $editImg = $this->Html->image('edit.png',array(
                            'title'=>__('Edit',true)." $vehicleName",
                            'alt'=>__('Edit',true)." $vehicleName",
                            'class'=>'span-1 last',
                    ));
                    echo $this->Html->link($editImg, '/vehicles/edit/'.$v['Vehicle']['id'], array(
                    'escape'=>false,
                    'class'=>'span-1 last images-link-1'));
                    ?>
            </span>
            <div id="formulario-de-<?= $v['Vehicle']['id']?>" style="display: none;" class="box-list-forms">
                <h2>Seleccionar Formulario para</h2>
                <h3><?= $vehicleName?></h3>
                    <? echo $this->Html->link('01','/field_creators/addForm/F01/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('02','/f02s/add/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('03','/field_creators/addForm/F03/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('04','/field_creators/addForm/F04/'.$v['Vehicle']['id']);?>
                <br />
                    <? echo $this->Html->link('08','/field_creators/addForm/F08/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('11','/field_creators/addForm/F11/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('12','/field_creators/addForm/F12/'.$v['Vehicle']['id']);?>
                <br />
                    <? echo $this->Html->link('13','/field_creators/addForm/F13/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('13','/field_creators/addForm/F13/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('31A','/field_creators/addForm/F31A/'.$v['Vehicle']['id']);?>
                    <? echo $this->Html->link('59M','/field_creators/addForm/59M/'.$v['Vehicle']['id']);?>

            </div>
        </li><?
        endforeach;
        ?>
    </ul>
</div>


<?
echo $this->Js->writeBuffer();
?>


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