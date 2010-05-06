<?php
class Customer extends AppModel {
    var $name = 'Customer';

    var $order = 'Customer.name';

    var $actsAs = array('Containable');


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
        'CustomerHome'=>array('dependent' => true,),
        'CustomerType'=>array('dependent' => true,),
        'Identification'=>array('dependent' => true,)
        );

    var $hasMany = array(
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



    function saveAllAboutCustomer($data) {
        $dataSource = $this->getDataSource();
        if ( $data['CustomerType']['type'] == 'fisica' ) {
            $data['CustomerType']['name'] = $data['CustomerType']['nameFisico'];
            $name = $data['CustomerType']['name']." ".$data['CustomerType']['surname'];
        } else {
            $name = $data['CustomerType']['name'] = $data['CustomerType']['nameJuridico'];
        }

        $data['Customer']['name'] = $name;
        if (!$this->save($data)){
            $dataSource->rollback($this);
            return -1;
        }

        $data['CustomerType']['customer_id'] = $this->id;
        if (!$this->CustomerType->save($data)) {
            $dataSource->rollback($this);
            return -2;
        }

        $data['Identification']['customer_id'] = $this->id;
        if (!$this->Identification->save($data)) {
            $dataSource->rollback($this);
            return -3;
        }

        $data['CustomerHome']['customer_id'] = $this->id;
        if (!$this->CustomerHome->save($data)) {
            $dataSource->rollback($this);
            return -4;
        }

        $dataSource->commit($this);
        return 1;
    }
}
?>