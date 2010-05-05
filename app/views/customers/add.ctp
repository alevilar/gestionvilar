<div class="customers form span-8 prepend-6">
    <?php echo $this->Form->create('Customer');?>
    <div id="fieldWrapper">
        <div id="first" class="span-8 step">
            <fieldset>
                <legend><?php printf(__('Add %s', true), __('Customer', true)); ?></legend>
                <?php
                echo $this->Form->hidden('name');

                $options = array('fisica'=>__('Natural', true),'juridica'=>__('Legal', true));
                echo $this->Form->input('CustomerType.type',array(
                'type'=>'select',
                'options'=>$options,
                'empty'=>'Seleccione',
                'class'=>'link required',
                ));

                echo $this->Jqform->date('born', array('label'=> 'Fecha de Creación / Nacimiento', 'minYear'=>1910));

                echo $this->Form->input('Identification.idenfication_type_id', array('empty'=>'Seleccione', 'class'=>'required'));
                echo $this->Form->input('Identification.number', array('class'=>'required'));
                echo $this->Form->input('Identification.authority_name');

                //echo $this->Form->button('Guardar',array('type'=>'submit'));
                ?>
            </fieldset>
        </div>

        <div id="fisica" class="span-8 step">
            <fieldset>
                <legend id="customer-type-legend"><?php printf(__('Add %s', true), __('Natural Person', true)); ?></legend>
                <div id="attr-fisicos">
                    <?php
                    echo $this->Form->input('CustomerNatural.name');
                    echo $this->Form->input('CustomerType.surname');
                    echo $this->Form->input('CustomerType.marital_status_id', array('empty'=>'Seleccione'));
                    echo $this->Form->input('CustomerType.nuptials');
                    echo $this->Form->input('CustomerType.spouse');
                    ?>
                    <input type="hidden" class="link" value="CustomerHome" />
                </div>
            </fieldset>
        </div>
        <div id="juridica" class="span-8 step">
            <fieldset>
                <legend id="customer-type-legend"><?php printf(__('Add %s', true), __('Legal Person', true)); ?></legend>
                <div id="attr-juridicos">
                    <?
                    echo $this->Form->input('CustomerLegal.name');
                    echo $this->Form->input('CustomerType.inscription_entity');
                    echo $this->Form->input('CustomerType.inscription_number');
                    ?>
                    <input type="hidden" class="link" value="CustomerHome" />
                </div>
            </fieldset>
        </div>

        <div id="CustomerHome" class="span-8 last step">
            <fieldset>
                <legend><?php printf(__('Add %s', true), __('Customer Home', true)); ?></legend>
                <?php
                echo $this->Form->input('CustomerHome.adress', array('class'=>'required'));
                echo $this->Form->input('CustomerHome.number', array('class'=>'required'));
                echo $this->Form->input('CustomerHome.floor', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                echo $this->Form->input('CustomerHome.apartment', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                echo $this->Form->input('CustomerHome.postal_code', array('div'=>array('class'=>'span-3 last'), 'class'=>'span-2'));
                echo $this->Form->input('State');
                echo $this->Form->input('County');
                echo $this->Form->input('CustomerHome.city_id', array('class'=>'required'));
                ?>
            </fieldset>
        </div>

    </div>

    <div id="demoNavigation">
        <input class="navigation_button" value="Regresar" type="reset">
        <input class="navigation_button" value="Siguiente" type="submit">
    </div>
</div>

<?php echo $this->Form->end();?>





<script type="text/javascript">

    /**
     * Form Wizard
     */
    $(function(){
        $("#CustomerAddForm").formwizard({ //wizard settings
            formPluginEnabled: false, //Ajax is used to post the form to the server
            validationEnabled : true, //The Validation plugin is used for validating the form at each step
            focusFirstInput : true, // puts focus at the first input on each step
            textSubmit: 'Enviar',
            textNext: 'Siguiente',
            textBack: 'Regresar'
        },
        {
            // aca van oppciones de jquery.validator pero yo no quiero cambiar nada
        },
        {
            resetForm: true
        }
    );
    });


    function activarValidacionesPersonaFisica(){
        $('#CustomerNaturalName').addClass('required');
        $('#CustomerTypeSurname').addClass('required');
        $('#attr-juridicos').children().removeClass('required');
    }


    function activarValidacionesPersonaJuridica(){
        $('#CustomerLegalName').addClass('required');
        $('#CustomerTypeInscriptionEntity').addClass('required');
        $('#CustomerTypeInscriptionNumber').addClass('required');

        $('#attr-fisicos').children().removeClass('required');
    }





    function listenEventCustomerTypeChange(){
        if (this.value == 'fisica'){
            activarValidacionesPersonaFisica();
        } else if (this.value == 'juridica'){
            activarValidacionesPersonaJuridica();
        } else {
            $('#attr-juridicos').children().removeClass('required');
            $('#attr-fisicos').children().removeClass('required');
        }
    }

    $(window).ready(listenEventCustomerTypeChange);

    $('#CustomerTypeType').change(listenEventCustomerTypeChange);

</script>