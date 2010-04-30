<div class="customers form">
    <?php echo $this->Form->create('Customer');?>
    <fieldset class="span-6">
        <legend><?php printf(__('Add %s', true), __('Customer', true)); ?></legend>
        <?php
        echo $this->Form->hidden('name');
        echo $this->Form->input('born');
        $options = array('natural'=>__('Natural', true),'legal'=>__('Legal', true));
        ?>
    </fieldset>

    <fieldset  class="span-6 last">
        <legend><?php printf(__('Add %s', true), __('Customer Type', true)); ?></legend>
        <?php
        echo $this->Form->input('CustomerType.type',array('type'=>'select','options'=>$options));
        echo $this->Form->input('CustomerType.name');
        echo $this->Form->input('CustomerType.surname');
        echo $this->Form->input('CustomerType.marital_status_id');
        echo $this->Form->input('CustomerType.nuptials');
        echo $this->Form->input('CustomerType.spouse');
        echo $this->Form->input('CustomerType.inscription_entity');
        echo $this->Form->input('CustomerType.inscription_number');
        echo $this->Form->input('CustomerType.inscription_date');
        ?>
    </fieldset>



    <fieldset class="span-6">
        <legend><?php printf(__('Add %s', true), __('Identification', true)); ?></legend>
        <?php
        echo $this->Form->input('Identification.idenfication_type_id');
        echo $this->Form->input('Identification.number');
        echo $this->Form->input('Identification.authority_name');
        ?>
    </fieldset>


    <fieldset>
        <legend><?php printf(__('Add %s', true), __('Customer Home', true)); ?></legend>
        <?php
        echo $this->Form->input('CustomerHome.adress');
        echo $this->Form->input('CustomerHome.number');
        echo $this->Form->input('CustomerHome.floor');
        echo $this->Form->input('CustomerHome.apartment');
        echo $this->Form->input('CustomerHome.postal_code');
        echo $this->Form->input('CustomerHome.customer_id');
        echo $this->Form->input('State');
        echo $this->Form->input('County');
        echo $this->Form->input('CustomerHome.city_id');
        ?>
    </fieldset>

    <?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Homes', true)), array('controller' => 'customer_homes', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Home', true)), array('controller' => 'customer_homes', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customer Types', true)), array('controller' => 'customer_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer Type', true)), array('controller' => 'customer_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identifications', true)), array('controller' => 'identifications', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification', true)), array('controller' => 'identifications', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Representatives', true)), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Representative', true)), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Vehicles', true)), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Vehicle', true)), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
    </ul>
</div>