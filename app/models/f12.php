<?php

App::import('Lib', 'FormSkeleton');


class F12 extends FormSkeleton {
   


    var $belongsTo = array('Vehicle');

    // Id del Formulario
    var $form_id = 8;



    function getJavascript(){
        $texto1 = 'HE VERIFICADO PERSONALMENTE LA AUTENTICIDAD DE LOS DATOS QUE FIGURAN EN EL PRESENTE FORMULARIO Y ME HAGO PERSONALMENTE RESPONSABLE CIVIL Y CRIMINALMENTE POR LOS ERRORES U OMISIONES EN QUE PUDIERA INCURRIR, SIN PERJUICIO DE LAS QUE A LA EMPRESA LE CORRESPONDA.';
        $texto2 = 'HE VERIFICADO PERSONALMENTE LA AUTENTICIDAD DE LOS DATOS QUE FIGURAN EN EL PRESENTE FORMULARIO Y ME HAGO PERSONALMENTE RESPONSABLE CIVIL Y CRIMINALMENTE POR LOS ERRORES U OMISIONES EN QUE PUDIERA INCURRIR, SIN PERJUICIO DE LAS QUE A LA EMPRESA LE CORRESPONDAN.  SE REALIZA LA PRESENTE EN NUESTRO CARACTER DE HABITUALISTA Nº ( ESTO CAMBIA) REA00012 Y POR HABER INTERVENIDO EN LA GESTION DE IMPORTACION. (DIGESTO: TIT. I - CAP. VII - SEC. 5ª - ART. 6 - 2º PARRAFO.)';

        return "
            $('#textobs').change(function(){
                if ($(this).val() == 1){
                    $('textarea[name=\"data[F12][observaciones]\"]').html('$texto1');
                } else if ($(this).val() == 2) {
                    $('textarea[name=\"data[F12][observaciones]\"]').html('$texto2');
                } else {
                    $('textarea[name=\"data[F12][observaciones]\"]').html('');
                }
            });
            

";
    }


    function getFormImputs($data)
    {
        $obs = array(
                'Sin Texto',
                'Texto 1',
                'Texto 2',
        );
        
        return array(
            array(
                'legend'=> 'Datos del Automotor Verificado',
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
                'legend'=>'Observaciones y/o constancias',
                'texto_de_la_observacion'=> array('label'=>'Seleccione el texto dela observación','options'=>$obs, 'id'=>'textobs', 'after'=>'(recuede retocar la observación)'),
                'observaciones'=> array('type'=>'textarea'),
                'lugar',
                'fecha_dia'=> array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Día'),
                'fecha_mes'=> array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes'),
                'fecha_anio'=> array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año'),
            ),
            array(
                'legend'=>'Datos del Solicitante',
                'nombre' => array('label'=>'Apellido y Nombre', 'value'=>$data['Vehicle']['Customer']['name']),
                'tipoynrodoc'=>array('label'=>'N° y tipo de documento', 'value'=> $this->getTipoYNumero()),
                'domicilio' => array('value'=>$data['Vehicle']['Customer']['Home']['address']),
                'numero' => array('value'=>$data['Vehicle']['Customer']['Home']['number']),
                'localidad' => array('value'=>$data['Vehicle']['Customer']['Home']['city']),
            )
        );
    }


    function setSContain() {
        $this->sContain = array(
                'Vehicle' => array(
                        'Customer'=>array(
                                'CustomerHome',
                                'Identification'=>array('IdentificationType')
                        )
                )
        );
    }

}

?>
