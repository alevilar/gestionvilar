<?php
/* Customer Test cases generated on: 2010-04-28 19:04:44 : 1272493604*/
App::import('Model', 'Customer');

class CustomerTestCase extends CakeTestCase {
    var $fixtures = array('app.customer', 'app.customer_home', 'app.city', 
        'app.county', 'app.state', 'app.customer_type', 'app.marital_status',
        'app.identification', 'app.representative', 'app.vehicle');


    function startTest() {
        $this->Customer =& ClassRegistry::init('Customer');
    }

    function endTest() {
        unset($this->Customer);
        ClassRegistry::flush();
    }


    function testAlgo(){
        die("asasas ds da das d");
        debug("2738738923");
        $this->assertEqual(1, 2);
    }

    function saveAllAboutCustomerTest() {
        $cant = $this->Customer->find('count');
        $cant_identificaciones = $this->Customer->Identification->find('count');

        $data = array(
            'CustomerType' => array(
                'type' => 'fisica',
                'nameFisico' => 'nombre fisico',
                'surname' => 'apellido',
                'marital_status_id' => 1,
                'nuptials' => '',
                'spouse' => '',
            ),

            'Customer' => array(
                'born' => array(
                    'day' => 05,
                    'month' => 05,
                    'year' => 2010,
                ),
                'State' => 1,
                'County' => 1,
            ),

            'Identification' => array(
                'idenfication_type_id' => 1,
                'number' => 232323,
                'authority_name' => '',
            ),

            'CustomerHome' => array(
                'adress' => 'luis viale',
                'number' => 2420,
                'floor' => 2,
                'apartment' => 3,
                'postal_code' => 1416,
                'city_id' => 1,
            ),
        );
        $this->Customer->saveAllAboutCustomer($data);

        $cant2 = $this->Customer->find('count');
        $cant_identificaciones2 = $this->Customer->Identification->find('count');

        debug($this->Customer->find('all'));
        $this->assertEqual(1, 2);
        $this->assertEqual($cant2, $cant+1);
        $this->assertEqual($cant_identificaciones2, $cant_identificaciones+1);
    }

}
?>