<?
$this->Paginator->options(array(
        'update' => '#customer-search-box',
        'model'=>'Customer',
        'url'=>array('controller'=>'customers', 'action' => 'index','pagModel'=>'Customer'),
    ));
//debug($paginator)?>
<div  id="customer-and-vehicle-list" class="span-24 last">
    <?php echo $this->element('buscador'); ?>

    <?php echo $this->element('customer_index'); ?>

    <?php echo $this->element('vehicles_from_customer', $vehicles);?>
    
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
       // $('#div-for-vehicles').load("<?= $this->Html->url('/vehicles'); ?>")
    });



    function updateVehicleHeader(){
        $('#vehicle-list-header').hide();
        $('#vehicle-header-customer').show();
        $('#vehicle-customer-title').html(customer.name);
        $('#btn-cliente-view').attr('href','<?php echo $this->Html->url('/customers/view/')?>'+customer.id);
        $('#btn-add-vehicle').attr('href','<?php echo $this->Html->url('/vehicles/add/')?>'+customer.id);
    };
</script>


