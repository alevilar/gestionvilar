<div class="box">
    <?= $this->Html->image('user.png', array('height'=>'40px', 'class'=>'pull-1'));?>
    <div class="span-8">
        <h2 class="center">
            <? echo $customer['Customer']['name']?>
        </h2>
    </div>
    <div class="span-5 last">
        <? echo $this->Html->link('Editar Cliente', '/customers/edit/'.$customer['Customer']['id'])?>
        <? echo $this->Html->link('Agregar Vehiculo', '/vehicles/add/'.$customer['Customer']['id'])?>
    </div>

    <div class="search-content span-13 last" id="vehicle-list">
        <ul class="simple-list">
            <?php
            $i = 0;
            foreach ($vehicles as $v):
                ?>
            <li class='hover-highlight'>
                    <? $vehicleName = $v['Vehicle']['brand']." ".$v['Vehicle']['type']." ".$v['Vehicle']['model']; ?>
                <span class="span-11"><?= $this->Html->link($vehicleName,'/vehicles/edit/'.$v['Vehicle']['id'], array('class'=>'alto3em'));?></span>
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

    <?
    if (count($vehicles) == 0) {
        echo "<div class='notice span-12 last'>"
            .__('This customer has no vehicles',true)
            ." "
            .$this->Html->link('haga click aquí para agregar uno','/vehicles/add/'.$customer['Customer']['id'])
            ."</div>";
    }
    ?>

</div>




