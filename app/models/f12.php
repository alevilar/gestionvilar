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


    function mapData() {
        $d = $this->data;
        $this->populateFieldWithValue('dominio', $d['Vehicle']['patente']);
        $this->populateFieldWithValue('MARCA', $d['Vehicle']['brand']);
        $this->populateFieldWithValue('TIPO', $d['Vehicle']['type']);
        $this->populateFieldWithValue('MODELO', $d['Vehicle']['model']);
        $this->populateFieldWithValue('MARCA MOTOR', $d['Vehicle']['motor_brand']);
        $this->populateFieldWithValue('N° MOTOR', $d['Vehicle']['motor_number']);
        $this->populateFieldWithValue('MARCA CHASIS', $d['Vehicle']['chasis_brand']);
        $this->populateFieldWithValue('N° CHASIS', $d['Vehicle']['chasis_number']);
        $this->populateFieldWithValue('OBSERVACIONES', $d['F12']['observaciones']);
        $this->populateFieldWithValue('LUGAR', $d['F12']['lugar']);
        $this->populateFieldWithValue('FECHA - DIA', date('d',strtotime($d['F12']['fecha'])));
        $this->populateFieldWithValue('FECHA - MES', date('m',strtotime($d['F12']['fecha'])));
        $this->populateFieldWithValue('FECHA - AÑO', date('y',strtotime($d['F12']['fecha'])));

        $this->populateFieldWithValue('APELLIDO Y NOMBRE', $d['F12']['nombre']);
        $this->populateFieldWithValue('N° Y DNI', $d['F12']['tipoynrodoc']);
        $this->populateFieldWithValue('CALLE', $d['F12']['domicilio']);
        $this->populateFieldWithValue('N°', $d['F12']['numero']);
        $this->populateFieldWithValue('LOCALIDAD', $d['F12']['localidad']);

/*
        $this->populateFieldWithValue('APELLIDO Y NOMBRE', $d['Vehicle']['Customer']['name']);
        if (!empty($d['Vehicle']['Customer']['Identification']['IdentificationType']))
            $this->populateFieldWithValue('N° Y DNI', $d['Vehicle']['Customer']['Identification']['IdentificationType']['name']. ' ' .$d['Vehicle']['Customer']['Identification']['number']);
        if (!empty($d['Vehicle']['Customer']['CustomerHome'])) {
            foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {
                if ($h['type']== 'Legal') {
                    $this->populateFieldWithValue('CALLE', $h['address']);
                    $this->populateFieldWithValue('N°', $h['number']);
                    $this->populateFieldWithValue('LOCALIDAD', $h['city']);
                    break;
                }
            }
        }
 * */
    }
}

?>
