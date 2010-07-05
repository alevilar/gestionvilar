<?php

App::import('Lib', 'FormSkeleton');


class F12 extends FormSkeleton {
    var $validate = array(
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


    var $belongsTo = array('Vehicle');


    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    function getFieldCreatorId() {
        return 8;
    }



    function getFormImputs($data)
    {
        return array(
            array(
                'legend'=> 'Datos del Automotor Verificado',
                'vehicle_id' => array('type'=>'hidden', 'value'=>$data['Vehicle']['id']),
                'vehicle_patente'=> array('value'=>$data['Vehicle']['patente']),
                'vehicle_brand' => array('value'=>$data['Vehicle']['brand']),
                'vehicle_type' => array('value'=>$data['Vehicle']['type']),
                'vehicle_model' => array('value'=>$data['Vehicle']['model']),
                'vehicle_motor_brand' => array('value'=>$data['Vehicle']['motor_brand']),
                'vehicle_motor_number' => array('value'=>$data['Vehicle']['motor_number']),
                'vehicle_chasis_brand' => array('value'=>$data['Vehicle']['chasis_brand']),
                'vehicle_chasis_number' => array('value'=>$data['Vehicle']['chasis_number']),
            ),
            array(
                'legend'=>'Observaciones y/o constancias',
                'observaciones'=> array('type'=>'textarea'),
                'lugar',
                'fecha_dia'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Día', 'value'=> date('d',strtotime('now'))),
                'fecha_mes'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Mes', 'value'=> date('m',strtotime('now'))),
                'fecha_anio'=>array('div'=>array('class'=>'span-1'), 'class'=>'span-1', 'label'=>'Año', 'value'=> date('y',strtotime('now'))),
            ),
            array(
                'legend'=>'Datos del Solicitante',
                'nombre' => array('label'=>'Apellido y Nombre', 'value'=>$data['Vehicle']['Customer']['name']),
                'tipoynrodoc'=>array('label'=>'N° y tipo de documento', 'value'=>$data['Vehicle']['Customer']['identification_type']. " ".$data['Vehicle']['Customer']['identification_number']),
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
