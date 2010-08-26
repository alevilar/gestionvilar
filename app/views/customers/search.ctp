<? //debug($paginator)?>
<div  id="customer-and-vehicle-list" class="span-24 last">

    <div class="column span-9">
        <div class="span-9 column-header">
            <?= $this->Html->image('playlist.png', array('height'=>'40px', 'style'=>'float:left'));?>
            <h2 class="center"><? __('Customer´s List')?></h2>
        </div>
        <div  class="span-9">
            <?php
            $this->Paginator->options(array('update' => '#customer-and-vehicle-list','model'=>'Customer','url'=>array('pagModel'=>'Customer')));
            echo $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
            // echo $this->Paginator->numbers();
            echo $this->Paginator->next(' Siguiente »',  null,null, array('class' => 'disabled'));
            ?>
        </div>
        <div  id="customer-search-box" class="search-content span-9">
            <ul class="simple-list">
                <? foreach ($customers as $c) {
                    $hrId = 'customer-vehicles-'.$c['Customer']['id'];
                    $imgSgte = $this->Html->image('next.png',array('width'=>'20'));
                    //$imgCustomerInfo = $this->Html->image('customer_view.png',array('width'=>'14'));
                    //$linkCustomerInfo = $this->Html->link($imgCustomerInfo,'/customers/view/'.$c['Customer']['id'], array('escape'=>false, 'class'=>'span-1 alto3em'));
                    $customerName = $this->Js->link(
                            $c['Customer']['name'].$imgSgte,
                            '/vehicles/customer/'.$c['Customer']['id'],
                            array(
                            'class'   => 'alto3em',
                            'escape'  => false,
                            'customer'=> $c['Customer']['id'],
                            'update'  => '#vehicle-list',
                            'complete'=>'updateVehicleHeader()',
                    ));
                    $customerId = $c['Customer']['id'];
                    echo "<li class='hover-highlight'>$customerName</li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="column span-14 last"  id="vehicle-search-box" >
        <div id="vehicle-list-header" class="column-header">
            <?= $this->Html->image('playlist.png', array('height'=>'40px', 'style'=>'float:left'));?>
            <h2 class="center"><? __('Vehicle´s List')?></h2>
        </div>

        <div id="vehicle-header-customer" class="span-13 column-header" style="display: none;">
            <?= $this->Html->image('user.png', array('height'=>'40px', 'style'=>'float:left'));?>
            <h2 id="vehicle-customer-title" class="center span-9"></h2>
            <div class="span-3 last">
                <? echo $this->Html->link('Más Info Cliente', '#', array('id'=>'btn-cliente-view'))?>
                <br>
                <? echo $this->Html->link('Agregar Vehiculo', '#', array('id'=>'btn-add-vehicle'))?>
            </div>
        </div>

        <div class="span-14 last" id="div-for-vehicles"></div>
    </div>
    <?
    echo $this->Js->writeBuffer();
    ?>
</div>

<script type="text/javascript">
    $('.hover-highlight').hover(function() {
        $(this).addClass('li-hover');
    }, function() {
        $(this).removeClass('li-hover');
    });


    $(document).ready(function(){
        $('#div-for-vehicles').load("<?= $this->Html->url('/vehicles'); ?>")
    });



    function updateVehicleHeader(){
        $('#vehicle-list-header').hide();
        $('#vehicle-header-customer').show();
        $('#vehicle-customer-title').html(customer.name);
        $('#btn-cliente-view').attr('href','<?php echo $this->Html->url('/customers/view/')?>'+customer.id);
        $('#btn-add-vehicle').attr('href','<?php echo $this->Html->url('/vehicles/add/')?>'+customer.id);
    };
</script>


