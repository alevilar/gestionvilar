<?php
class County extends AppModel {
    var $name = 'County';

    var $order = 'County.name';

    var $validate = array(
            'state_id' => array(
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
            'State' => array(
                            'className' => 'State',
                            'foreignKey' => 'state_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasMany = array(
            'City' => array(
                            'className' => 'City',
                            'foreignKey' => 'county_id',
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


    function findFromState($state_id = 0) {
        $cond = array();
        if ($state_id != 0) {
            $cond =  array('County.state_id'=>$state_id);
        }
        $counties = $this->find('all', array(
                'conditions'=> $cond,
                'order'=> array('County.name', 'City.name'),
                'contain' => array('County'=>'State'),
        ));

        foreach ($counties as &$c) {
            $ci = $c['City']['name'];
            $co = $c['County']['name'];
            if(strlen($ci)>19) {
                $ci = substr($ci,0,19);
                $ci .= '...';
            }
            if(strlen($co)>19) {
                $co = substr($co,0,19);
                $co .= '...';
            }
            $name = "$ci ($co)";
            $c['City']['name'] = $name;
        }

        return $counties;
    }

}
?>