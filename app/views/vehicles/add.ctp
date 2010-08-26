<h2><?php  echo $html->link(sprintf(__('Customer %s: %s',true),$customer['Customer']['type'], $customer['Customer']['name']), '/customers/view/'.$customer['Customer']['id']);?></h2>

<div class="vehicles form span-24 last">
    <?php echo $this->Form->create('Vehicle');?>
    <fieldset class="span-24 last">
        <legend><?php printf(__('Add %s', true), __('Vehicle', true)); ?></legend>
        <div class="span-6">
<?php
             echo $this->Form->textarea('notes', array('class'=>'notes span-6','rows'=>14));

             ?>
        </div>
        <div class="span-6">
            <?php
            echo $this->Form->hidden('customer_id');
            echo $this->Form->input('vehicle_type_id', array(
            'empty'=>'Seleccione',
            'options'=>$vehicle_types,
            'label'=>'Clase de Vehiculo',
                'class'=>'required',
            )
            );
            echo $this->Form->input('fabrication_certificate');
            echo $this->Form->input('brand');
            echo $this->Form->input('type');

            ?>
        </div>

        <div class="span-6">
            <?php
            echo $this->Form->input('model');
            echo $this->Form->input('use');
            echo $this->Form->input('patente');
            echo $this->Form->input('adquisition_value');
            echo $this->Jqform->date('adquisition_date');
            ?>
        </div>


        <div class="span-6 last">
            <?
            echo $this->Form->input('adquisition_evidence_element');
            echo $this->Form->input('motor_brand');
            echo $this->Form->input('motor_number');
            echo $this->Form->input('chasis_brand');
            echo $this->Form->input('chasis_number');

            ?>
        </div>

    </fieldset>

    <?php echo $this->Form->end('Guardar');?>

</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#VehicleEditForm').validate();
    });

    $('#VehiclePatente').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
</script>
