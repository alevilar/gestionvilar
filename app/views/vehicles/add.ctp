<div class="vehicles form box">
    <?php echo $this->Form->create('Vehicle');?>
    <fieldset>
        <legend><?php printf(__('Add %s', true), __('Vehicle', true)); ?></legend>

        <div class="span-7">
            <?php
            echo $this->Form->hidden('customer_id');
            echo $this->Form->input('fabrication_certificate');
            echo $this->Form->input('brand');
            echo $this->Form->input('type');
            echo $this->Form->input('model');
            echo $this->Form->input('use');
            ?>
        </div>

        <div class="span-7">
            <?php
            echo $this->Form->input('adquisition_value');
            echo $this->Jqform->date('adquisition_date');
            echo $this->Form->input('adquisition_evidence_element');
            ?>
        </div>


        <div class="span-7 last">
            <?
            echo $this->Form->input('motor_number');
            echo $this->Form->input('chasis_brand');
            echo $this->Form->input('chasis_number');
            echo $this->Form->input('motor_brand');
            ?>
        </div>
        <?php echo $this->Form->end(__('Submit', true));?>
    </fieldset>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Vehicles', true)), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Customers', true)), array('controller' => 'customers', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Customer', true)), array('controller' => 'customers', 'action' => 'add')); ?> </li>
    </ul>
</div>