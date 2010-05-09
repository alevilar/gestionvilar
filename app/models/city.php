<?php
class City extends AppModel {
    var $name = 'City';

    var $order = 'City.name';

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

    
    function findFromState($state_id = 0) {
        $cities = $this->find('all', array(
                'conditions'=> array('County.state_id'=>$state_id),
                'order'=> array('County.name', 'City.name'),
                'contain' => array('County'=>'State'),
        ));
        
        foreach ($cities as &$city) {
            $ci = $city['City']['name'];
            $co = $city['County']['name'];
            if(strlen($ci)>19) {
                $ci = substr($ci,0,19);
                $ci .= '...';
            }
            if(strlen($co)>19) {
                $co = substr($co,0,19);
                $co .= '...';
            }
            $name = "$ci ($co)";
            $city['City']['name'] = $name;
        }

        return $cities;
    }

}
?>