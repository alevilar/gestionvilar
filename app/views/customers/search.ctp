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
                $customerName = $this->Js->link(
                        $c['Customer']['name'].$imgSgte,
                        '/vehicles/customer/'.$c['Customer']['id'],
                        array(
                        'class'   => 'alto3em',
                        'escape'  => false,
                        'customer'=> $c['Customer']['id'],
                        'update'  => '#vehicle-search-box',
                ));
                $customerId = $c['Customer']['id'];
                echo "<li class='hover-highlight'>$customerName</li>";
            }
            ?>
        </ul>
    </div>
</div>

<div class="column span-14 last"  id="vehicle-search-box" >
    <div class="column-header">
        <?= $this->Html->image('playlist.png', array('height'=>'40px', 'style'=>'float:left'));?>
        <h2 class="center"><? __('Vehicle´s List')?></h2>
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
    }); ;
</script>


