<? $rand = (int)rand(10, 989898);?>
<div class="agents form" id="<?php echo "#edit-agent-div-$rand";?>">

    <?php echo $this->Form->create('Agent');?>
    <fieldset>
        <legend><?php printf(__('Edit %s', true), __('Agent', true)); ?></legend>
        <fieldset>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('first_name');
            echo $this->Form->input('surname');
            echo $this->Form->input('identification_type_id');
            echo $this->Form->input('identification_number');
            echo $this->Form->input('license');
            echo $this->Form->input('super_license', array('label'=>__('Other License',true)));
            ?>
        </fieldset>
        <fieldset>
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
    <?php echo $this->Js->submit(__('Submit', true), array('url'=> array('action'=>'edit'), 'update' => '#edit-agent-div-'.$rand));?>
    <?php echo $this->Form->end();?>
</div>

<?

echo $js->writeBuffer();