<script type="text/javascript">


    /**
     * Form Wizard
     */
    $(function(){
        $("#CharacterForm").formwizard({ //wizard settings
            formPluginEnabled: false, //Ajax is used to post the form to the server
            validationEnabled : true, //The Validation plugin is used for validating the form at each step
            focusFirstInput : true, // puts focus at the first input on each step
            textSubmit: 'Guardar',
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

</script>



<?php if (!empty($customer['Customer']['name'])) { ?>

<h1>Cliente: <?= $customer['Customer']['name']?></h1>
<?php } ?>

<div class="characters form">
<?php
$url = 'add';
if (!empty($customer['Customer']['id'])) {
    $url .= '/'.$customer['Customer']['id'];
}
echo $this->Form->create('Character', array('url'=>$url, 'id'=>'CharacterForm'));?>

    <?php
        if(!empty($this->data['Character']['id'])) {
            echo $this->Form->input('id');
            $add_or_edit = 'Edit';
        } else {
            $add_or_edit = 'Add';
        }
    ?>

    <div id="first" class="step">
	<fieldset>
            <legend><?php echo __($add_or_edit,true). ' '.__('Character',true); ?></legend>
            <?php
            echo $this->Form->input('customer_id', array('empty'=>'Éste Actor se puede utilizar con todos los clientes'));
            echo $this->Form->input('character_type_id');
            echo $this->Form->input('porcentaje',array('after'=>'Si el número va con decimal hay que poner punto en lugar de la coma Ej:45.32 '));
            echo $this->Form->input('cuit_cuil', array('label'=>'CUIT o CUIL', 'after'=>'aqui se debe escribir EJ. "CUIT 30-4545654-1" y seria utilizado únicamente en aquellos formularios que requieran obligatoriamente mostrar dicho valor. Útil en Formulario 08, por ejemplo.'));
            echo $this->Form->input('name', array('after'=>'Generalmente aqui se deba escribir Apellido y Nombre'));
            echo $this->Form->input('persona_fisica_o_juridica', array('options'=>array('Física'=>'Física','Jurídica'=>'Jurídica'), 'class'=>'link'));
            ?>
        </fieldset>

        <fieldset>
            <legend><?php __('Address'); ?></legend>
            <?
            echo $this->Form->input('calle');
            echo $this->Form->input('numero_calle', array('label'=>__('Number',true)));
            echo $this->Form->input('piso');
            echo $this->Form->input('depto');
            echo $this->Form->input('cp', array('label'=>__('Postal Code',true)));
            echo $this->Form->input('localidad');
            echo $this->Form->input('departamento');
            echo $this->Form->input('provincia');
            ?>
        </fieldset>
    </div>


    <div id="Física" class="step submit_step">

        <fieldset>
            <legend><?php  __('Extra Information'); ?></legend>
            <?
            echo $this->Form->input('identification_type_id', array('empty'=>'Seleccione'));
            echo $this->Form->input('identification_number');
            echo $this->Form->input('nationality_type_id');
            echo $this->Form->input('identification_authority');
            echo $this->Jqform->date('fecha_nacimiento');
            ?>
        </fieldset>

        <fieldset>
            <legend><?php  __('Spouse'); ?></legend>
            <?
            echo $this->Form->input('marital_status_id',array('empty'=>'Seleccione'));
            echo $this->Form->input('nupcia');
            echo $this->Form->input('conyuge', array('label'=>__('Spouse',true)));
            ?>
            <h2>Apoderado del Cónyuge</h2>
              <?
           echo $this->Form->input('conyuge_apoderado_name', array('label'=>'Apellido y Nombre del Apoderado'));
            echo $this->Form->input('conyuge_apoderado_identification_type_id', array('label'=>'Tipo de Doc.', 'options'=>$identificationTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('conyuge_apoderado_identification_number', array('label'=>'N° Doc.'));
            echo $this->Form->input('conyuge_apoderado_nationality_type', array('label'=>'Nacionalidad', 'options'=>$nationalityTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('conyuge_apoderado_identification_auth', array('label'=>'Autoridad (o país) que lo expidió', 'after'=>'completar sólo, si el apoderado es extranjero'));
              ?>
        </fieldset>

        <fieldset>
            <legend>Apoderado</legend>
            <?
            echo $this->Form->input('apoderado_name', array('label'=>'Apellido y Nombre del Apoderado'));
            echo $this->Form->input('apoderado_identification_type_id', array('label'=>'Tipo de Doc.', 'options'=>$identificationTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('apoderado_identification_number', array('label'=>'N° Doc.'));
            echo $this->Form->input('apoderado_nationality_type', array('label'=>'Nacionalidad', 'options'=>$nationalityTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('apoderado_identification_auth', array('label'=>'Autoridad (o país) que lo expidió', 'after'=>'completar sólo, si el apoderado es extranjero'));
            ?>
        </fieldset>
    </div>

    <div id="Jurídica" class="step submit_step">

        <fieldset>
            <legend><?php  __('Extra Information'); ?></legend>
            <?
            echo $this->Form->input('personeria_otorgada');
            echo $this->Form->input('inscripcion', array('label'=>'Inscripción'));
            echo $this->Jqform->date('fecha_inscripcion');
            ?>
        </fieldset>


        <fieldset>
            <legend>Apoderado del Actor</legend>
            <?
            echo $this->Form->input('apoderado_name', array('label'=>'Apellido y Nombre del Apoderado'));
            echo $this->Form->input('apoderado_identification_type_id', array('label'=>'Tipo de Doc.', 'options'=>$identificationTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('apoderado_identification_number', array('label'=>'N° Doc.'));
            echo $this->Form->input('apoderado_nationality_type', array('label'=>'Nacionalidad', 'options'=>$nationalityTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('apoderado_identification_auth', array('label'=>'Autoridad (o país) que lo expidió', 'after'=>'completar sólo, si el apoderado es extranjero'));
            ?>
        </fieldset>
    </div>

    <div id="formNavigation">
        <input class="navigation_button" value="Regresar" type="reset">
        <input class="navigation_button" value="Siguiente" type="submit">
    </div>
<?php echo $this->Form->end();?>
</div>