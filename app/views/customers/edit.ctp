
<div class="customers form span-18 prepend-3">
    <?php echo $this->Form->create('Customer');?>
    <div id="fieldWrapper">
        <div id="first" class="span-18 step">
            <fieldset class="span-16 column">
                <legend><?php printf(__('%s', true), __('Customer', true)); ?></legend>
                <div class="span-8">
                    <?php
                    if (!empty($this->data['Customer']['id'])) {
                        echo $this->Form->input('Customer.id');
                    }
                    echo $this->Form->input('Customer.type',array(
                    'empty'=>'Seleccione',
                    'class'=>'link required',
                    ));

                    echo $this->Jqform->date('born', array('label'=> 'Fecha de Creación / Nacimiento', 'minYear'=>1910));
                    ?>
                </div>
                <div class="span-8 last">
                    <?
                    if (!empty($this->data['Identification']['id'])) {
                        echo $this->Form->input('Identification.id');
                    }
                    echo $this->Form->input('Identification.identification_type_id', array('empty'=>'Seleccione'));
                    echo $this->Form->input('Identification.number');
                    echo $this->Form->input('Identification.authority_name');
                    ?>
                </div>
            </fieldset>
        </div>

        <div id="natural" class="span-16 step">
            <fieldset  class="span-16 column">
                <legend id="customer-type-legend"><?php printf(__('Add %s', true), __('Natural Person', true)); ?></legend>
                <div class="span-8">
                    <?php
                    if (!empty($this->data['CustomerNatural']['id'])) {
                        echo $this->Form->input('CustomerNatural.id');
                    }
                    echo $this->Form->input('CustomerNatural.first_name', array('label'=>'Nombre', 'class'=>'required'));
                    echo $this->Form->input('CustomerNatural.surname', array('class'=>'required'));
                    ?>
                </div>
                <div class="span-8 last">
                    <?
                    echo $this->Form->input('CustomerNatural.marital_status_id', array('empty'=>'Seleccione'));
                    echo $this->Form->input('CustomerNatural.nuptials');
                    //echo $this->Form->input('CustomerNatural.spouse');
                    ?>
                    <input type="hidden" class="link" value="CustomerHome" />
                </div>
            </fieldset>
        </div>
        <div id="legal" class="span-16 step">
            <fieldset class="span-16 column">
                <legend id="customer-type-legend"><?php printf(__('Add %s', true), __('Legal Person', true)); ?></legend>
                <div class="span-8">
                    <?
                    if (!empty($this->data['CustomerLegal']['id'])) {
                        echo $this->Form->input('CustomerLegal.id');
                    }
                    echo $this->Form->input('CustomerLegal.name', array('class'=>'required'));
                    ?>
                </div>
                <div class="span-8 last">
                    <?
                    echo $this->Form->input('CustomerLegal.inscription_entity');
                    echo $this->Form->input('CustomerLegal.inscription_number');
                    ?>
                    <input type="hidden" class="link" value="CustomerHome" />
                </div>
            </fieldset>
        </div>
<? //debug($this->data['CustomerHome'])?>
        <div id="CustomerHome" class="span-16 step">
            <fieldset class="span-16 column">
                <legend>
                    <?php
                    $homeType = (!empty($this->data['CustomerHome'][0]['type']))?$this->data['CustomerHome'][0]['type']:'Legal';
                    echo $homeType;
                    ?>
                </legend>
                <div class="span-8">
                    <?php
                    if (!empty($this->data['CustomerHome'][0]['id'])) {
                        echo $this->Form->input('CustomerHome.0.id');
                    }
                    echo $this->Form->hidden('CustomerHome.0.type', array('value'=>$homeType));
                    echo $this->Form->input('CustomerHome.0.city');
                    ?>
                </div>
                <div class="span-8 last">
                    <?
                    echo $this->Form->input('CustomerHome.0.address', array());
                    echo $this->Form->input('CustomerHome.0.number', array());
                    echo $this->Form->input('CustomerHome.0.floor', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                    echo $this->Form->input('CustomerHome.0.apartment', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                    echo $this->Form->input('CustomerHome.0.postal_code', array('div'=>array('class'=>'span-3 last'), 'class'=>'span-2'));
                    ?>
                </div>
            </fieldset>

            <fieldset class="span-16 column direcciones-legales">
                <legend>
                    <?php
                    $homeType = (!empty($this->data['CustomerHome'][1]['type']))?$this->data['CustomerHome'][1]['type']:'Comercial';
                    echo $homeType;
                    ?>
                </legend>
                <div class="span-8">
                    <?php
                    if (!empty($this->data['CustomerHome'][1]['id'])) {
                        echo $this->Form->input('CustomerHome.1.id');
                    }
                    echo $this->Form->hidden('CustomerHome.1.type', array('value'=>$homeType));
                    echo $this->Form->input('CustomerHome.1.city');
                    ?>
                </div>
                <div class="span-8 last">
                    <?
                    echo $this->Form->input('CustomerHome.1.address', array());
                    echo $this->Form->input('CustomerHome.1.number', array());
                    echo $this->Form->input('CustomerHome.1.floor', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                    echo $this->Form->input('CustomerHome.1.apartment', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                    echo $this->Form->input('CustomerHome.1.postal_code', array('div'=>array('class'=>'span-3 last'), 'class'=>'span-2'));
                    ?>
                </div>
            </fieldset>

            <fieldset class="span-16 column direcciones-legales">
                <legend>
                    <?php
                    $homeType = (!empty($this->data['CustomerHome'][2]['type']))?$this->data['CustomerHome'][2]['type']:'Guarda Habitual';
                    echo $homeType;
                    ?>
                </legend>
                <div class="span-8">
                    <?php
                    if (!empty($this->data['CustomerHome'][2]['id'])) {
                        echo $this->Form->input('CustomerHome.2.id');
                    }
                    echo $this->Form->hidden('CustomerHome.2.type', array('value'=>$homeType));
                    echo $this->Form->input('CustomerHome.2.city');
                    ?>
                </div>
                <div class="span-8 last">
                    <?
                    echo $this->Form->input('CustomerHome.2.address', array());
                    echo $this->Form->input('CustomerHome.2.number', array());
                    echo $this->Form->input('CustomerHome.2.floor', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                    echo $this->Form->input('CustomerHome.2.apartment', array('div'=>array('class'=>'span-2'), 'class'=>'span-2'));
                    echo $this->Form->input('CustomerHome.2.postal_code', array('div'=>array('class'=>'span-3 last'), 'class'=>'span-2'));
                    ?>
                </div>
            </fieldset>
        </div>

    </div>

    <div id="formNavigation">
        <input class="navigation_button" value="Regresar" type="reset">
        <input class="navigation_button" value="Siguiente" type="submit">
    </div>
</div>

<?php echo $this->Form->end();?>





<script type="text/javascript">

     $(document).ready(mostrarDireccionesLegales);
     $('#CustomerType').change(mostrarDireccionesLegales);

    function mostrarDireccionesLegales(){
           if ($('#CustomerType').val() == 'legal') {
               $('.direcciones-legales').show();
           } else {
               $('.direcciones-legales').hide();
           }
    }
    
    /**
     * Form Wizard
     */
    $(function(){
        $("#Customer<?= Inflector::camelize($this->action)?>Form").formwizard({ //wizard settings
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


    $(function(){
        $("select#CustomerHomeStateId").change(function(){
            $.getJSON("<?= $this->Html->url('/cities/from_state.json') ?>",{state_id: $(this).val(), ajax: 'true'}, function(j){
                var options = '';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i]['City'].id + '">' + j[i]['City'].name + '</option>';
                }
                $("select#CustomerHomeCityId").html(options);
            });
        })
    })


</script>