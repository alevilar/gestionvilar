
<div class="search-content span-13 last" id="vehicle-list">
    <ul class="simple-list">
        <?php
        $i = 0;
        foreach ($vehicles as $v):
            ?>
        <li class='hover-highlight span-13 last'>
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
                    echo $this->Html->image($img, array('width'=>'38px'));
                    ?>
            </span>
                <? 
                $vehicleName = "[".$v['Vehicle']['patente']."] ".$v['Vehicle']['brand']." ".$v['Vehicle']['type']." ".$v['Vehicle']['model'];
                $vehicleName .= ($this->action=='search')?' - '.$v['Customer']['name']:'';
                ?>
            <span class="span-10"><?= $this->Html->link($vehicleName,'/vehicles/edit/'.$v['Vehicle']['id'], array('class'=>'alto3em'));?></span>
            <span class="span-2 last">
                    <?
                    $pdfImg = $this->Html->image('pdf.png',array(
                            'title'=>__('Print',true)." $vehicleName",
                            'alt'=>__('Print',true)." $vehicleName",
                    ));
                    echo $this->Html->link($pdfImg, 'javascript: alert("Imprimir Formulario")', array(
                    'escape'=>false,
                    'class'=>'span-1  images-link-1'));

                    $editImg = $this->Html->image('edit.png',array(
                            'title'=>__('Edit',true)." $vehicleName",
                            'alt'=>__('Edit',true)." $vehicleName",
                    ));
                    echo $this->Html->link($editImg, '/vehicles/edit/'.$v['Vehicle']['id'], array(
                    'escape'=>false,
                    'class'=>'span-1 last images-link-1'));
                    ?>
            </span>
        </li><?
        endforeach;
        ?>
    </ul>
</div>

