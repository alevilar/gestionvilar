<?php
class Customer extends AppModel {
    var $name = 'Customer';

    var $order = 'Customer.name';

    var $actsAs = array('Containable');


    var $types = array('natural'=>"Física",'legal'=>"Jurídica");


    var $validate = array(
            'name' => array(
                            'notempty' => array(
                                            'rule' => array('notempty'),
                                            'message' => 'El nombre no puede quedar vacio',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                            ),
            ),
            'born' => array(
                            'date' => array(
                                            'rule' => array('date'),
                            //'message' => 'Your custom message here',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                            ),
            ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $hasOne = array(
            'CustomerNatural'=>array('dependent' => true,),
            'CustomerLegal'=>array('dependent' => true,),
            'Identification'=>array('dependent' => true,)
    );

    var $hasMany = array(
            'CustomerHome'=>array('dependent' => true,),
            'Representative' => array('dependent' => true),
            'Condominium' => array('dependent' => true),
            'Vehicle' => array('dependent' => true),
    );

    /*
    function  __construct() {
        $this->types = array('fisica'=>__('Natural', true),'juridica'=>__('Legal', true));
        //$this->types = array('fisica'=>'Física','juridica'=>'Jurídica');
    }
    */

    function saveAllAboutCustomer($data) {
        $dataSource = $this->getDataSource();
        if ( $data['Customer']['type'] == 'natural' ) {
            $data['Customer']['name'] = $data['CustomerNatural']['surname']. ' ' .$data['CustomerNatural']['first_name'];
        } else {
            $data['Customer']['name'] = $data['CustomerLegal']['name'];
        }

        if (!empty($data['Customer']['id'])) {
            $this->id = $data['Customer']['id'];
        }

        if (!$dev = $this->save($data['Customer'])) {
            $dataSource->rollback($this);
            return -1;
        }


        if ( $data['Customer']['type'] == 'natural' ) {
            $data['CustomerNatural']['customer_id'] = $this->id;
            if (!$this->CustomerNatural->save($data['CustomerNatural'])) {
                $dataSource->rollback($this);
                return -21;
            }
            $data['CustomerNatural']['id'] = $this->CustomerNatural->id;
        } else {
            $data['CustomerLegal']['customer_id'] = $this->id;
            if (!$this->CustomerLegal->save($data['CustomerLegal'])) {
                $dataSource->rollback($this);
                return -22;
            }
            $data['CustomerLegal']['id'] = $this->CustomerLegal->id;
        }


        if (!empty($data['Identification']['number'])) {
            $data['Identification']['customer_id'] = $this->id;
            if (!$this->Identification->save($data['Identification'])) {
                $dataSource->rollback($this);
                return -3;
            }
            $data['Identification']['id'] = $this->Identification->id;
        }

        $dataHome = array();
        if (!empty($data['CustomerHome'])) {
            foreach ($data['CustomerHome'] as $ch) {
                if (!empty($ch['address'])) {
                    $dataHome[] = $ch;
                }
            }
            $data['CustomerHome'] = $dataHome;
        }
        if (!empty($data['CustomerHome'])) {
            $cont = 0;
            foreach ($data['CustomerHome'] as $home) {
                $home['customer_id'] = $this->id;
                $this->CustomerHome->create();
                if (!$this->CustomerHome->save($home)) {
                    $dataSource->rollback($this);
                    return -4;
                }
                $data['CustomerHome'][$cont]['id'] = $this->CustomerHome->id;
                $cont++;
            }
        }
        $this->data = $data;
        $dataSource->commit($this);
        return 1;
    }
}
?>