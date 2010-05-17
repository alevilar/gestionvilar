<?php
class City extends AppModel {
    var $name = 'City';

    var $order = 'City.name';

    var $actsAs = array('Containable');

    var $validate = array(
            'county_id' => array(
                            'numeric' => array(
                                            'rule' => array('numeric'),
                            //'message' => 'Your custom message here',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                            ),
            ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
            'County' => array(
                            'className' => 'County',
                            'foreignKey' => 'county_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasMany = array(
            'CustomerHome' => array(
                            'className' => 'CustomerHome',
                            'foreignKey' => 'city_id',
                            'dependent' => false,
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


    function findFromCounty($county_id) {
        $cities = $this->find('all', array(
                'conditions'=> array('City.county_id'=>$county_id),
                'contain' => array('County'),
        ));
        return $cities;
    }


    function getWithCountyAndState($conditions) {
        $cities = $this->find('all', array(
                'contain' => array('County'),
                'fields' => array("CONCAT(City.name,' ',County.name,' ')"),
                'conditions' => $conditions,
        ));

       // debug($cities);
        return $cities;
        
    }

}
?>