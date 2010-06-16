<div class="actions span-7">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Agents', true)), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('controller' => 'identification_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification Type', true)), array('controller' => 'identification_types', 'action' => 'add')); ?> </li>
    </ul>
</div>

<div class="agents form span-17 last">

    <?php echo $this->Form->create('Agent');?>
    <fieldset>
        <legend><?php printf(__('Add %s', true), __('Agent', true)); ?></legend>
        <fieldset class="span-8">
            <?php
            echo $this->Form->input('first_name');
            echo $this->Form->input('surname');
            echo $this->Form->input('identification_type_id');
            echo $this->Form->input('identification_number');
            echo $this->Form->input('license');
            echo $this->Form->input('super_license', array('label'=>__('Other License',true), 'after'=>"<br>".__('licencia de la persona que representa',true)));
            ?>
        </fieldset>
        <fieldset class="9 last">
            <?php
            echo $this->Form->input('address');
            echo $this->Form->input('address_number');
            echo $this->Form->input('address_floor');
            echo $this->Form->input('address_apartment');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('state');
            ?>
        </fieldset>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true));?>
</div>
