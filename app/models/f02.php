<?php


class F02 extends AppModel {

    var $types = array(
        0  => 'Anotación de embargos, litis, medidas de no innovar y otras medidas precautorias',
        1  => 'Levantamiento de embargos, litis, medidas de no innovar y otras medidas precautorias',
        2  => 'Anotación de inhibiciones, afectaciones y otras medidas precautorias del tipo personal',
        3  => 'Levantamiento de inhibiciones, afectaciones y otras medidas precautorias del tipo personal',
        4  => 'Certificado de estado de dominio, bloquea el dominio por 15 días hábiles',
        5  => 'Informe de estado de dominio, no bloquea el dominio',
        6  => 'Anotación de comunicaciones de siniestros que formulen las compañias aseguradoras',
        7  => 'Anotación de comunicaciones que formulen las autoridades policiales',
        8  => 'Certificado de transferencia',
        9  => 'Duplicado de certificado de baja de vehiculo',
        10 => 'Duplicado de certificado de baja de motor',
        11 => 'Duplicado de certificado de baja de carroceria y/o chasis',
        12 => 'Duplicado de certificado de denunia de robo o hurto',
        13 => 'Duplicado de certificado de comunicacion de recupero',
        14 => 'Asignación codificación de identificacion de motor y/o chasis',
        15 => 'Duplicado de título',
        16 => 'Duplicado de cédula, renovacion o cédula adicional',
        17 => 'Cambio de uso',
        18 => 'Certificado de otras constancias registrales',
        19 => 'Otros trámites',
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
    
}

?>
