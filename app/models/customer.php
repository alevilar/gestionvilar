<?php
class Customer extends AppModel {
    var $name = 'Customer';

    var $order = 'Customer.name';

    var $actsAs = array('Containable');


    var $types = array('natural'=>'Física','legal'=>'Jurídica');


    var $validate = array(
            'name' => array(
                            'notempty' => array(
                                            'rule' => array('notempty'),
                            //'message' => 'Your custom message here',
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
            'Representative' => array(
                            'className' => 'Representative',
                            'foreignKey' => 'customer_id',
                            'dependent' => true,
                            'conditions' => '',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            ),
            'Vehicle' => array(
                            'className' => 'Vehicle',
                            'foreignKey' => 'customer_id',
                            'dependent' => true,
                            'conditions' => '',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            )
    );

    /*
    function  __construct() {
        $this->types = array('fisica'=>__('Natural', true),'juridica'=>__('Legal', true));
        //$this->types = array('fisica'=>'Física','juridica'=>'Jurídica');
    }
    */

    function saveAllAboutCustomer($data) {
        $dataSource = $this->getDataSource();
        if ( $data['Customer']['type'] == 'fisica' ) {
            $data['Customer']['name'] = $data['CustomerNatural']['first_name']." ".$data['CustomerNatural']['surname'];
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


        if ( $data['Customer']['type'] == 'fisica' ) {
            $data['CustomerNatural']['customer_id'] = $this->id;
            if (!$this->CustomerNatural->save($data['CustomerNatural'])) {
                $dataSource->rollback($this);
                return -2;
            }
        } else {
            $data['CustomerLegal']['customer_id'] = $this->id;
            if (!$this->CustomerLegal->save($data['CustomerLegal'])) {
                $dataSource->rollback($this);
                return -2;
            }
        }


        if (!empty($data['Identification']['number'])) {
            $data['Identification']['customer_id'] = $this->id;
            if (!$this->Identification->save($data['Identification'])) {
                $dataSource->rollback($this);
                return -3;
            }
        }


        if (!empty($data['CustomerHome'])) {
            foreach ($data['CustomerHome'] as $home) {
                $home['customer_id'] = $this->id;
                $this->CustomerHome->create();
                if (!$this->CustomerHome->save($home)) {
                    $dataSource->rollback($this);
                    return -4;
                }
            }
        }

        $dataSource->commit($this);
        return 1;
    }
}
?>