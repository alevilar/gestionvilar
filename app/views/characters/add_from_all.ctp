<div class="characters form">
<?php echo $this->Form->create('Character', array('url'=>'add_from_all'));?>
	<fieldset>
            <legend><?php echo __('Add',true). ' '.__('Character',true); ?></legend>
            <?php
            echo $this->Form->input('customer_id');
            echo $this->Form->input('character_type_id');
            echo $this->Form->input('porcentaje',array('after'=>'Si el número va con decimal hay que poner punto en lugar de la coma Ej:45.32 '));
            echo $this->Form->input('name', array('after'=>'Generalmente aqui se deba escribir Apellido y Nombre'));
            echo $this->Form->input('persona_fisica_o_juridica', array('options'=>array('Física'=>'Física','Jurídica'=>'Jurídica')));
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
        <fieldset>
            <legend><?php  __('Extra Information'); ?></legend>
            <?
            echo $this->Form->input('identification_type_id', array('empty'=>'Seleccione'));
            echo $this->Form->input('identification_number');
            echo $this->Form->input('nationality_type_id');
            echo $this->Form->input('identification_authority');
            echo $this->Jqform->date('fecha_nacimiento');
            echo $this->Form->input('personeria_otorgada');
            echo $this->Form->input('inscripcion', array('label'=>'Inscripción'));
            echo $this->Jqform->date('fecha_inscripcion');
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
            <legend>Apoderado del Condominio</legend>
            <?
            echo $this->Form->input('apoderado_name', array('label'=>'Apellido y Nombre del Apoderado'));
            echo $this->Form->input('apoderado_identification_type_id', array('label'=>'Tipo de Doc.', 'options'=>$identificationTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('apoderado_identification_number', array('label'=>'N° Doc.'));
            echo $this->Form->input('apoderado_nationality_type', array('label'=>'Nacionalidad', 'options'=>$nationalityTypes,'empty'=>'Seleccione'));
            echo $this->Form->input('apoderado_identification_auth', array('label'=>'Autoridad (o país) que lo expidió', 'after'=>'completar sólo, si el apoderado es extranjero'));
            ?>
        </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>