<div id="customer-index" class="column span-9">
    <div class="span-9 column-header">
        <?= $this->Html->image('playlist.png', array('height' => '40px', 'style' => 'float:left')); ?>
        <h2 class="center"><? __('Customer´s List') ?></h2>
    </div>
    <div  class="span-9">
        <?php
        
        $this->Paginator->options(array(

            'update' => '#customer-index',
            'model' => 'Customer',
            'url' => array(
                'controller'=>'customers',
                'action'=>'index',
                ) + $this->passedArgs + array('redirect' => 'CustomerIndex'),
            ));
        echo $this->Paginator->counter(array('format' => 'Página %page% de %pages%. Total: %count% Clientes', 'model'=>'Customer'));
        echo $this->Paginator->prev('« Anterior ', array('model'=>'Customer'), null, array('class' => 'disabled'));
        // echo $this->Paginator->numbers();
        echo $this->Paginator->next(' Siguiente »', array('model'=>'Customer'), null, array('class' => 'disabled'));
        ?>
    </div>
    <div  id="customer-search-box" class="search-content span-9">
        <ul class="simple-list">
            <?
            foreach ($customers as $c) {
                $hrId = 'customer-vehicles-' . $c['Customer']['id'];
                $imgSgte = $this->Html->image('next.png', array('width' => '20'));
                //$imgCustomerInfo = $this->Html->image('customer_view.png',array('width'=>'14'));
                //$linkCustomerInfo = $this->Html->link($imgCustomerInfo,'/customers/view/'.$c['Customer']['id'], array('escape'=>false, 'class'=>'span-1 alto3em'));
                $customerName = $this->Html->link(
                                $c['Customer']['name'] . $imgSgte,
                                '/vehicles/customer/' . $c['Customer']['id'],
                                array(
                                    'class' => 'alto3em',
                                    'rel' => 'history',
                                    'escape' => false,
                                    'customer' => $c['Customer']['id'],
                                //  'update'  => '#div-for-vehicles',
                        ));
                $customerId = $c['Customer']['id'];
                echo "<li class='hover-highlight'>$customerName</li>";
            }
            ?>
        </ul>
    </div>
</div>

<?php
echo $this->Js->writeBuffer();