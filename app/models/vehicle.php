<?php

class Vehicle extends AppModel
{

    var $name = 'Vehicle';
    var $validate = array(
        'customer_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'vehicle_type_id' => array(
                'rule' => array('notEmpty'),
                'message' => array('Debe ingresar un Tipo de Vehiculo.')
            ),
        ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array('Customer', 'VehicleType');
    /**
     * Es paa traerme TODOS los datos necesarios para armar llos formularios
     * @var array Containable Behaiviour
     */
    var $sContain = array(
        'Customer' => array(
            'Character' => array('CharacterType'),
            'Representative',
            'CustomerLegal',
            'CustomerNatural' => array('Spouse'),
            'CustomerHome',
            'Identification' => array('IdentificationType')
        )
    );

    /**
     * es el find de cake pero para definir segun cada formulario
     * @param string data si es data entonces en fields le paso 1ero el Id del
     * formulario, si no lo encuentra porque aun no esta creado, entonces uso el id del vehiculo
     *
     * @param array fields array('form_id','vehicle_id')
     */
    public function find($conditions = 'data', $fields = array(), $order = null, $recursive = null)
    {
        // hacer el FIND tipico
        if ($conditions != 'data') {
            return parent::find($conditions, $fields, $order, $recursive);
        }

        if ($conditions == 'data') {
            if (empty($fields['vehicle_id'])) {
                $fields['vehicle_id'] = $this->id;
            }
            $ret = $this->find('first', array(
                        'conditions' => array('Vehicle.id' => $fields['vehicle_id']),
                        'contain' => $this->sContain,
                    ));
            if (!empty($ret['Vehicle']['Customer'])) {
                $ret['Customer'] = $ret['Vehicle']['Customer'];
            }
            
            return $this->acomodarDatosTraidos($ret);
        }
    }

    /**
     * Luego de in find('data') debo querer acomodar lo que me devuelve utilizando esta funcion
     * @param array  $ret lo que devuelve el find 'data'
     */
    function acomodarDatosTraidos($ret = null)
    {
        if (empty($ret)) {
            $ret = $this->data;
        }
        $this->data = $ret;
        if (!empty($ret['Customer']) && empty($ret['Vehicle']['Customer'])) {
                $ret['Vehicle']['Customer'] = $ret['Customer'];
                unset($ret['Customer']);
            }

            // DOMICILIO
            $encontrado = false;
            if (!empty($ret['Vehicle']['Customer']['CustomerHome'])) {
                foreach ($ret['Vehicle']['Customer']['CustomerHome'] as $h) {
                    if ($h['type'] == 'Legal') {
                        foreach ($h as $k => $v) {
                            $ret['Vehicle']['Customer']['Home'][$k] = $v;
                        }
                        $encontrado = true;
                        break;
                    }
                    if (!$encontrado) {
                        if ($h['type'] == 'Comercial') {
                            foreach ($h as $k => $v) {
                                $ret['Vehicle']['Customer']['Home'][$k] = $v;
                            }
                            $encontrado = true;
                            break;
                        }
                    }
                    if (!$encontrado) {
                        foreach ($h as $k => $v) {
                            $ret['Vehicle']['Customer']['Home'][$k] = $v;
                        }
                    }
                }
            }

            // IDENTIFICACION
            if (!empty($ret['Vehicle']['Customer']['Identification']['IdentificationType'])) {
                $ret['Vehicle']['Customer']['identification_type'] = $ret['Vehicle']['Customer']['Identification']['IdentificationType']['name'];
                $ret['Vehicle']['Customer']['identification_number'] = $ret['Vehicle']['Customer']['Identification']['number'];
            }

            // Actores Genericos
            if (!empty($ret['Vehicle']['Customer']['id'])) {
                $actoresGen = $this->Customer->Character->find('all', array(
                            'contain' => array('CharacterType'),
                            'conditions' => array(
                                'OR' => array(
                                    'Character.customer_id' => $ret['Vehicle']['Customer']['id'],
                                    'Character.customer_id IS NULL',
                                )
                            )
                        ));
                foreach ($actoresGen as $aG) {
                    $ret['Vehicle']['Customer']['Character'][] = $aG['Character'];
                }
                //debug($actoresGen);
            }
            return $ret;
    }

}

?>