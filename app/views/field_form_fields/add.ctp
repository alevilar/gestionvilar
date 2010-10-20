
<div class="fieldFormFields form">
    <?php echo $this->Form->create('FieldFormField'); ?>
    <fieldset>
        <legend><?php printf(__('Add %s', true), __('Field Form Field', true)); ?></legend>
        <?php
        echo $this->Form->button(__('Download PDF', true), array('id' => 'pdf', 'type' => 'submit'));
        echo $this->Form->button(__('Reset', true), array('type' => 'reset'));

        echo $this->Form->input('Info.printer_id', array(
            'label' => array('text' => 'Impresora a utilizar', 'class' => 'span-3 prepend-1'),
            'after' => $this->Html->link('¿Desea configurar otra impresora?', '/printers/add', array('escape' => false)),
                )
        );

        echo $this->Form->hidden('FieldForm.vehicle_id');
        echo $this->Form->hidden('FieldForm.field_creator_id');

        $i = 0;
        ?>

        <div class="clear"></div>


        <div id="opciones-de-eleccion" class="clear span-24 last"><hr />
        <h3 class="letra-marron"
            >Seleccione los datos dinámicos que desea agregar</h3>
            <?php
                echo $this->element('field_forms/customer_to_character', array(
                            'label'=>'Clientes',
                            'formName' => 'FieldFormFieldAddForm',
                            'options'=>array('
                                customer'=>'Insertar datos del Cliente'
                                )
                    ));

                echo $this->element('field_forms/character_data', array(
                    'formName' => 'FieldFormFieldAddForm',
                    ));
            ?>
        </div>

        <div class="clear"></div>

        <?php
        foreach ($fields as $f) {
            echo $this->Form->hidden($i . '.field_form_id', array('value' => $field_form_id));
            echo $this->Form->hidden($i . '.field_coordenate_id', array('value' => $f['FieldCoordenate']['id']));
            $type = $f['FieldCoordenate']['field_type_id'] == 3 ? 'textarea' : 'text'; // si es multicelda que sea textarea
            echo $this->Form->input($i . '.value', array(
                'id' => empty($f['FieldCoordenate']['related_field_table'])?null:$f['FieldCoordenate']['related_field_table'],
                'label' => $f['FieldCoordenate']['name'],
                'type' => $type));
            $i++;
        }
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>

