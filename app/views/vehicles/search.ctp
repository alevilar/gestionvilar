
<div  id="customer-and-vehicle-list" class="span-24 last">
    <?php echo $this->element('buscador'); ?>
    
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
                    $customerName = $this->Html->link(
                            $c['Customer']['name'].$imgSgte,
                            '/vehicles/customer/'.$c['Customer']['id'],
                            array(
                            'class'   => 'alto3em',
                            'rel' => 'history',
                            'escape'  => false,
                            'customer'=> $c['Customer']['id'],
                          //  'update'  => '#div-for-vehicles',
                    ));
                    $customerId = $c['Customer']['id'];
                    echo "<li class='hover-highlight'>$customerName</li>";
                }
                ?>
            </ul>
        </div>
    </div>


    <div class="column span-15 last"  id="div-for-vehicles" >
        <? echo $this->element('vehicles_from_customer', $vehicles);?>
    </div>
</div>
<?
echo $this->Js->writeBuffer();
?>


<script type="text/javascript">
    $('.hover-highlight').hover(function() {
        $(this).addClass('li-hover');
    }, function() {
        $(this).removeClass('li-hover');
    });

</script>



