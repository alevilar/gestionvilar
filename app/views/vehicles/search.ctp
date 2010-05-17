
<div class="column span-9">
    <div class="span-9 column-header">
        <?= $this->Html->image('playlist.png', array('height'=>'40px', 'style'=>'float:left'));?>
        <h2 class="center"><? __('Customer´s List')?></h2>
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

<div class="column span-14 last" id="vehicle-search-box">
    <div class="column-header">
        <?= $this->Html->image('playlist.png', array('height'=>'40px', 'style'=>'float:left'));?>
        <h2 class="center"><? __('Vehicle´s List')?></h2>
    </div>
    <span style="float: right"><a href="#" onclick="$('#vehicle-search').toggle();">Buscador</a></span>
    <div class="column span-14 last" id="vehicle-search">
        <?= $this->Form->create('Vehicle', array('url'=>'/vehicles/search'));?>
        <?= $this->Form->input('Customer.name', array('label'=>'Cliente', 'div'=>array('class'=>'span-4'),'class'=>'span-4'));?>
        <?= $this->Form->input('patente', array('label'=>'N° Dominio', 'div'=>array('class'=>'span-2'),'class'=>'span-2'));?>
        <?= $this->Form->input('chasis_number', array('label'=>'N° Chasis', 'div'=>array('class'=>'span-3'),'class'=>'span-3'));?>
        <? //= $this->Js->submit('Buscar',array('update'=>'vehicle-list','div'=>array('class'=>'span-2 last prepend-top'),'class'=>'span-2 last'));?>
        <?= $this->Form->end('Buscar',array('div'=>array('class'=>'span-2 last prepend-top'),'class'=>'span-2 last'));?>
    </div>

    <div class="span-14 last">
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


