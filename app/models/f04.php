<?php

App::import('Lib', 'FormSkeleton');



class F04 extends FormSkeleton {
    var $name = 'F04';
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array('Vehicle','Character','Spouse', 'Representative');



    var $tipoTramites = array(
            1 => 'Solicitud de cambio de carroceria',
            2 => 'Denuncia de robo o hurto',
            3 => 'Denuncia de recupero',
            'Solicitud de baja de automotor' => array(
                            41 => 'Siniestro, desarme, desgaste o envejecimiento',
                            42 => 'Exportación definitiva'),
            'Solicitud de baja de motor solamente' => array(
                            51 => 'Destrucción, siniestro, desarme, desgaste',
                            52 => 'Otras causas'),
            'Solicitud de alta de motor' => array(
                            61 => 'Es nuevo y producido por una fábrica terminal nacional',
                            62 => 'Es nuevo e importado',
                            63 => 'Perteneció a un vehiculo inscripto en el R.N.P.A',
                            64 => 'Es usado, armado fuera de fábrica o de origen no previsto en los casos anteriores'),
            7 => 'Solicitud de cambio de domicilio del titular que fija el lugar de radicación del automotor',
    );

    var $form_id = 4;


    var $fieldsBlackList = array('modified', 'created', 'spouse_id');



    var $elements = array(
          array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array(
                                'propietario'=>'Propietario',
                                'condominiopropietario'=>'Condominio en la Propiedad',
                                ))),
          array('field_forms/character_data'=> array('field_prefix'=>'propietario', 'label'=>'Propietario')),
          array('field_forms/character_data'=> array('field_prefix'=>'condominiopropietario', 'label'=>'Condominio en la Propiedad')),
    );


    function beforeSave(){
        // inserto la X en el tipo de trámite
        $tramNum = $this->data[$this->name]['tipo_tramite'];
        $this->data[$this->name]['tipo_tramite_'.$tramNum] = 'X';
        if ($tramNum > 10) { // ademas tengo que poner otra X en el subgrupo
            $entero = (int)$tramNum / 10;
            $this->data[$this->name]['tipo_tramite_'.$entero] = 'X';
        }
        
        // PROPIETARIO
       $this->__ponerXPorIdentificationType('propietario');
       $this->__ponerXPorMaritalStatus('propietario');
       $this->__ponerXPorIdentificationType('propietario_conyuge_apoderado');

        // CONDOMINIO PROPIEDAD
       $this->__ponerXPorIdentificationType('condominiopropietario');
       $this->__ponerXPorMaritalStatus('condominiopropietario');
       $this->__ponerXPorIdentificationType('condominiopropietario_conyuge_apoderado');

       // ACREEDORES PRENDARIOS
       $this->__ponerXPorIdentificationType('acprendario2');
       $this->__ponerXPorIdentificationType('acprendario2');

         return true;
    }

    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
                array(
                    'legend' => '"D" Tipo de Trámite',
                    'ocupa-todoel-ancho' => true,
                    
                    'tipo_tramite' => array('options'=>$this->tipoTramites, 'empty'=>'Seleccione', 'label'=>'Tipo de Trámite'),
                    'd1_descripcion_tipo_vehiculo' => array('label'=>'Descripción del nuevo tipo de vehiculo (Ej: Sedan 4 puertas, camión grua, etc)',  'div'=> array('class'=>'tipo_de_tramite_1')),
                    'd5_motor_baja' => array('label'=>'Motor que se da de baja n°', 'div'=> array('class'=>'tipo_de_tramite_51 tipo_de_tramite_52')),
                    'd6_motor_alta' => array('label'=>'Marca del nuevo motor',  'div'=> array('class'=>'tipo_de_tramite_61 tipo_de_tramite_62 tipo_de_tramite_63 tipo_de_tramite_64')),
                    'd6_motor_numero_alta' => array('label'=>'Nuevo motor N°',  'div'=> array('class'=>'tipo_de_tramite_61 tipo_de_tramite_62 tipo_de_tramite_63 tipo_de_tramite_64')),
                    'd7_cambio_domicilio_calle' => array('label'=>'Calle',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_numero' => array('label'=>'Número',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_piso' => array('label'=>'Piso',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_depto' => array('label'=>'Depto',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_cp' => array('label'=>'Código Postal',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_localidad' => array('label'=>'Localidad o Capital Federal',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_partido' => array('label'=>'Partido o Departamento',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    'd7_cambio_domicilio_provincia' => array('label'=>'Provincia',  'div'=> array('class'=>'tipo_de_tramite_7')),
                    ),
            
            
            array(
                'legend'=>'"E" Automotor',
                'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                'vehicle_patente'=> array('label'=>'Dominio','value'=>$data['Vehicle']['patente']),
                'vehicle_brand' => array('label'=>'Marca','value'=>$data['Vehicle']['brand']),
                'vehicle_type' => array('label'=>'Tipo','value'=>$data['Vehicle']['type']),
                'vehicle_model' => array('label'=>'Modelo','value'=>$data['Vehicle']['model']),
                'vehicle_motor_brand' => array('label'=>'Marca del Motor','value'=>$data['Vehicle']['motor_brand']),
                'vehicle_motor_number' => array('label'=>'N° de Motor','value'=>$data['Vehicle']['motor_number']),
                'vehicle_chasis_brand' => array('label'=>'Marca del Chasis','value'=>$data['Vehicle']['chasis_brand']),
                'vehicle_chasis_number' => array('label'=>'N° de Chasis','value'=>$data['Vehicle']['chasis_number']),
            ),

             array(
                'legend'=>'"G" Deudas y gravámenes declarados por el Titular',
                'ocupa-todoel-ancho' => true,

                 'g1_fecha' => array('label'=>'Fecha de Inscripción',  'div'=> array('style'=>'float:left; clear: none;')),
                 'g1_importe'  => array('label'=>'Importe',  'div'=> array('style'=>'float:left; clear: none; margin-left: 10px;')),
                 'g1_acreedor'  => array('label'=>'Acreedor',  'div'=> array('style'=>'float:left; clear: none; margin-left: 10px;'), 'class'=>'span-10'),

                 'g2_fecha' => array('label'=>'Fecha de Inscripción',  'div'=> array('style'=>'float:left; clear: both;')),
                 'g2_importe'  => array('label'=>'Importe',  'div'=> array('style'=>'float:left; clear: none; margin-left: 10px;')),
                 'g2_acreedor'  => array('label'=>'Acreedor',  'div'=> array('style'=>'float:left; clear: right; margin-left: 10px;'), 'class'=>'span-10'),
             ),

            array(
                'legend' => '"H" Firma de Acreedor Prendario 1',
                'acprendario1_name' => array('label'=>'Apellido y Nombres del Acreedor Prendario'),
                'acprendario1_apoderado_name' => array('label'=>'Apellido y Nombres del Apoderado'),
                'acprendario1_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'acprendario1_apoderado_identification_number' => array('label'=>'Número'),
                'acprendario1_apoderado_identification_auth' => array('label'=>'Autoridad (o País) que lo expidió'),
                ),
            array(
                'legend' => '"H" Firma de Acreedor Prendario 2',
                'acprendario2_name' => array('label'=>'Apellido y Nombres del Acreedor Prendario'),
                'acprendario2_apoderado_name' => array('label'=>'Apellido y Nombres del Apoderado'),
                'acprendario2_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'acprendario2_apoderado_identification_number' => array('label'=>'Número'),
                'acprendario2_apoderado_identification_auth' => array('label'=>'Autoridad (o País) que lo expidió'),
            ),


            array(
                'legend'=>'"I" Propietario',
                'propietario_name'=>array('label'=>'Apellido y Nombre o Denominación'),
                'propietario_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'propietario_identification_number'=>array('label'=>'N° Documento'),
                'propietario_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'propietario_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'propietario_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'propietario_nupcia'=>array('label'=>'Nupcia'),
                'propietario_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),
                'propietario_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge'),
                'propietario_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'propietario_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento'),
                'propietario_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'propietario_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'propietario_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
                'i_fecha_sello'=>array('label'=>'Fecha, Sello y firma del certificante'),
            ),
            array(
                'legend'=>'"J" Condominio en la Propiedad',
                'condominiopropietario_name'=>array('label'=>'Apellido y Nombre o Denominación'),
                'condominiopropietario_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiopropietario_identification_number'=>array('label'=>'N° Documento'),
                'condominiopropietario_nationality_type_id'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiopropietario_identification_authority'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'condominiopropietario_marital_status_id'=>array('label'=>'Estado Civil', 'options'=>$maritalStatus, 'empty'=>'Seleccione'),
                'condominiopropietario_nupcia'=>array('label'=>'Nupcia'),
                'condominiopropietario_conyuge'=>array('label'=>'Apellido y nombres del cónyuge'),
                'condominiopropietario_conyuge_apoderado_name'=>array('label'=>'Apellido y nombres del cónyuge'),
                'condominiopropietario_conyuge_apoderado_identification_type_id'=>array('label'=>'Tipo de identificación','empty'=>'Seleccione','options'=>$identificationsTypes),
                'condominiopropietario_conyuge_apoderado_identification_number'=>array('label'=>'N° Documento'),
                'condominiopropietario_conyuge_apoderado_nationality_type'=>array('label'=>'Nacionalidad', 'options'=>$nationalities),
                'condominiopropietario_conyuge_apoderado_identification_auth'=>array('label'=>'Autoridad (o país) que lo expidió'),
                'condominiopropietario_apoderado_name'=>array('label'=>'Apellido y nombres del Apoderado'),
                'j_fecha_sello'=>array('label'=>'Fecha, Sello y firma del certificante'),
            ),

            array(
                 'legend'=>'"K" Observaciones',
                 'observaciones' => array('label'=>false),  
            ),
            array(
                'legend'=>'"M"',
                'm_autorizo' => array('label'=>'Autorizo a:'),
                'm_doc' => array('label'=>'Tipo y N° de Documento:'),
            ),


        );


        return $coso;
    }




    function getJavascript(){
        $codigo = '
            function mostrarInputsCorrectos(){
                $("[class^=tipo_de_tramite_]").hide();
                
                if ($(this).val()) { // cuando haya seleccionado que me haga esto:
                    $(".tipo_de_tramite_"+$(this).val()).show();

                }
                return true;
            }

            $(document).ready(mostrarInputsCorrectos);

            $("#F04TipoTramite").change(mostrarInputsCorrectos);


            $("legend").click(function(){
                //if (!mostrando) {
                     mostrarInputsCorrectos();
                     
                //}

            });

    ';
        return $codigo;
    }


}
?>