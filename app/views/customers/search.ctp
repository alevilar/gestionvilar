
<div class="column span-10">
    <div class="box">
        <?= $this->Html->image('playlist.png', array('height'=>'40px', 'class'=>'pull-1'));?>
        <h2 class="center"><? __('Customer´s List')?></h2>

        <div class="search-content" id="customer-search-box">
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
</div>

<div id="vehicle-search-box" class="column span-14 last">
    <div class="box">
        <?= $this->Html->image('playlist.png', array('height'=>'40px', 'class'=>'pull-1'));?>
        <h2 class="center"><? __('Vehicle´s List')?></h2>

        <div class="search-content" id="vehicle-list">
            <ul class="simple-list">
                <?
                foreach ($customers as $c) {
                    $hrId = 'customer-vehicles-'.$c['Customer']['id'];
                    foreach ($c['Vehicle'] as $v) {
                        $vehicleName = $this->Html->link($v['brand']." ".$v['type']." ".$v['model'],"#$hrId", array('class'=>'alto3em'));
                        echo "<li class='hover-highlight'>$vehicleName</li>";
                    }
                }
                ?>
            </ul>
        </div>
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


