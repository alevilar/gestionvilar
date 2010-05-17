<div class="vehicles form span-18 center prepend-3">
    <?php echo $this->Form->create('Vehicle');?>
    <fieldset class="span-18">
        <legend><?php printf(__('Edit %s', true), __('Vehicle', true)); ?></legend>

        <div class="span-6">
            <?php
            echo $this->Form->hidden('id');
            echo $this->Form->input('customer_id');
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
            echo $this->Form->input('motor_number');
            echo $this->Form->input('chasis_brand');
            echo $this->Form->input('chasis_number');
            echo $this->Form->input('motor_brand');
            ?>
        </div>

    </fieldset>

    <?php echo $this->Form->end('Guardar');?>

</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#VehicleEditForm').validate();
    });
</script>
