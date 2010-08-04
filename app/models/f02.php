<?php
App::import('Lib', 'FormSkeleton');


class F02 extends FormSkeleton {

    var $types = array(
            1  => 'Anotación de embargos, litis, medidas de no innovar y otras medidas precautorias',
            2  => 'Levantamiento de embargos, litis, medidas de no innovar y otras medidas precautorias',
            3  => 'Anotación de inhibiciones, afectaciones y otras medidas precautorias del tipo personal',
            4  => 'Levantamiento de inhibiciones, afectaciones y otras medidas precautorias del tipo personal',
            5  => 'Certificado de estado de dominio, bloquea el dominio por 15 días hábiles',
            6  => 'Informe de estado de dominio, no bloquea el dominio',
            7  => 'Anotación de comunicaciones de siniestros que formulen las compañias aseguradoras',
            8  => 'Anotación de comunicaciones que formulen las autoridades policiales',
            9  => 'Certificado de transferencia',
            10 => 'Duplicado de certificado de baja de vehiculo',
            11 => 'Duplicado de certificado de baja de motor',
            12 => 'Duplicado de certificado de baja de carroceria y/o chasis',
            13 => 'Duplicado de certificado de denunia de robo o hurto',
            14 => 'Duplicado de certificado de comunicacion de recupero',
            15 => 'Asignación codificación de identificacion de motor y/o chasis',
            16 => 'Duplicado de título',
            17 => 'Duplicado de cédula, renovacion o cédula adicional',
            18 => 'Cambio de uso',
            19 => 'Certificado de otras constancias registrales',
            20 => 'Otros trámites',
    );

    var $validate = array(
            'type' => array(
                            'notempty' => array(
                                            'rule' => array('notempty'),
                                            'message' => 'Debe seleccionar un valor.',
                            ),
                            'numeric' => array(
                                            'rule' => array('numeric'),
                                            'message'=>'Debe ingresar una valor numérico en este campo'
                            ),
            ),
            'vehicle_id' => array(
                            'notempty' => array(
                                            'rule' => array('notempty'),
                                            'message' => 'Debe seleccionar un valor.',
                            ),
                            'numeric' => array(
                                            'rule' => array('numeric'),
                                            'message'=>'Debe ingresar una valor numérico en este campo'
                            ),
            ),
    );


    var $belongsTo = array('Vehicle','Representative');

    var $form_id = 2;


    var $elements = array(
            'field_forms/representatives_data'=> array(),
    );



    function getJavascript(){
        $texto = 'Informe Histórico de Estado de Dominio respecto de embargos, prendas, Inhibiciones, denuncia de venta, cualquier otra medida cautelar que afecte al dominio. Codigo Automotor. Datos Sociedades. Fecha Titular Actual. Numeros de Control Cedula/s y Titulo vigente.';
      
        return "
            $('#txt_declaracion').change(function(){
                if ($(this).val() == 1){
                    $('textarea[name=\"data[F02][declaraciones]\"]').html('$texto');
                } else {
                    $('textarea[name=\"data[F02][declaraciones]\"]').html('');
                }
            });


";
    function setSContain() {
        $this->sContain = array(
                'Character',
                'Representative',
                'Spouse',
                'Vehicle' => array(
                        'Customer'=>array(
                                'Character'=>array('CharacterType'),
                                'Representative',
                                'CustomerLegal',
                                'CustomerNatural'=>array('Spouse'),
                                'CustomerHome',
                                'Identification'=>array('IdentificationType')
                        )
                )
        );
    }

    }


    public function beforeSave($options) {
        parent::beforeSave($options);
        

        if (!empty($this->data[$this->name]['d_tipo'])) {
            $numTipo = $this->data[$this->name]['d_tipo'];
            $this->data[$this->name]['d_tipo'.$numTipo] = 'X';
        }

        if (!empty($this->data[$this->name]['declaraciones'])) {
            $this->data[$this->name]['declaraciones'] = '                                        '.$this->data[$this->name]['declaraciones'];
        }



        /**
         *
         *
         *  representative_identification_dni
            representative_identification_le
            representative_identification_lc
            representative_identification_ext_dni
            representative_identification_ci
            representative_identification_pasap
         *
         */
        switch ($this->data[$this->name]['representative_identification_type_id']) {
            case 1: //DNI
                $this->data[$this->name]['representative_identification_dni'] = 'X';
                breaK;
            case 6: // Pasaporte
                $this->data[$this->name]['representative_identification_pasap'] = 'X';
                breaK;
            case 3: // LE
                $this->data[$this->name]['representative_identification_le'] = 'X';
                breaK;
            case 4: // LC
                $this->data[$this->name]['representative_identification_lc'] = 'X';
                breaK;
            case 5: // CI
                $this->data[$this->name]['representative_identification_ci'] = 'X';
                breaK;
        }
        
        return true;
    }

    function getFormImputs($data) {
         $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
         $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
         
        return array(
            array(
                'legend' => '"D" Solicitud De',
                'd_tipo' => array('label'=>false,'options'=>$this->types, 'class'=>'span-11'),
            ),
            array(
                'legend'=>'"E" Declaraciones',
                'texto_declaracion'=> array('id'=>'txt_declaracion','label'=>'¿Agregar Texto Automático a la declaracion?', 'options'=> array('No','Agregar Texto')),
                'declaraciones' => array('label'=>false),
            ),
            array(
                'legend'=> ' "F" Solicitante',
                'solicitante' => array('value'=>$this->data['Vehicle']['Customer']['name']),
                'representative_id' => array('type'=>'hidden'),
                'representative_name' => array('label'=>'Nombre'),
                'representative_nationality_type' => array('label'=>'Nacionalidad', 'options'=>$nationalities, 'empty'=>'Seleccione'),
                'representative_identification_type_id'=> array('label'=>'Tipo Documento', 'options'=>$identificationsTypes, 'empty'=>'Seleccione'),
                'representative_identification_number' => array('label'=>'N° Documento'),
                'representative_nationality' => array('label'=>'Autoridad (o Pais) que lo expidió'),
                'representative_fecha_firma' => array('label'=>'Fecha (para el sello y firma del certificante)'),
            ),
            array(
                'legend'=> '"H" Vehículo',
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

//        titular_name
//        titular_identification_dni
//        titular_identification_le
//        titular_identification_lc
//        titular_identification_ci
//        titular_identification_pasap
//        titular_identification_number
//        titular_identification_autority
//        titular_fecha_firma
//        titular_inscription_entity
//        titular_inscription_number
//        titular_inscription_date
//        l_vendedor_name
//        l_fecha_transferencia
//        type
//
//
//        nationality_type
//
//        description
//        o_autorizo_name
//        o_doc

        );
    }

}

?>
