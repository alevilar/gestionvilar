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



    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
                array(
                    'legend' => '"D" Tipo de Trámite',
                    'ocupa-todoel-ancho' => true,
                    
                    'tipo_tramite' => array('options'=>$this->tipoTramites, 'empty'=>'Seleccione'),
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
                'legend'=>'"G" Deudas',
                'ocupa-todoel-ancho' => true,

                 

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

            $("#F04TipoDeTrámite").change(mostrarInputsCorrectos);


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