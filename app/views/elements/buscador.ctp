<div id="vehicle-search" class="span-24 last">
    <?= $this->Form->create('Vehicle', array('url' => '/vehicles/search')); ?>
    <?= $this->Form->input('Customer.name', array('label' => 'Cliente', 'class' => 'span-4')); ?>
    <?= $this->Form->input('patente', array('label' => 'N° Dominio', 'class' => 'span-2')); ?>
    <?= $this->Form->input('chasis_number', array('label' => 'N° Chasis', 'class' => 'span-3')); ?>
    <?= $this->Form->input('motor_number', array('label' => 'N° Motor', 'class' => 'span-3')); ?>
    <? //= $this->Js->submit('Buscar',array('update'=>'vehicle-list','div'=>array('class'=>'span-2 last prepend-top'),'class'=>'span-2 last'));?>
    <?= $this->Form->end('Buscar', array('div' => array('class' => ''), 'class' => 'span-2 last')); ?>
</div>