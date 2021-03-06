<?php

class F02sController extends AppController{

    var $helpers = array('Fpdf');

    function add($vehicle_id = null) {

        if (empty($vehicle_id)) {
             if (empty($this->data['F02']['vehicle_id'])) {
                $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del vehículo');
                $this->redirect('/');
             } else {
                 $vehicle_id = $this->data['F02']['vehicle_id'];
             }
        }
        $conditions = array('F02.vehicle_id'=>$vehicle_id);
        
        if (!empty($this->data)) {
            if (!$this->F02->save($this->data)) {
                $this->Session->setFlash('no pudo guardarse el formulario 02');
            } else {
                $this->redirect('/f02s/generar_pdf/'.$this->F02->id.'.pdf');
            }
        } else {
            if (!empty($this->data['F02']['id'])) {
                $this->F02->id = $this->data['F02']['id'];
                $conditions = array('F02.id'=>$this->F02->id);
            }
        }
        $this->data = $this->F02->find('first', array(
                'conditions'=> $conditions,
                'contain' => array(
                    'Vehicle'=>array('Customer'=>array('Representative'))
                ),
            ));
        
        if (empty($this->data)) {
            $this->data = $this->F02->Vehicle->find('first', array(
                'conditions'=> array('Vehicle.id'=>$vehicle_id),
                'contain' => array(
                    'Customer'=>array('Representative')
                ),
            ));
        }

        if (!empty($this->data['Customer'])){
            $this->data['Vehicle']['Customer'] = $this->data['Customer'];
        }

        $representatives = array();
        if (!empty($this->data['Vehicle']['Customer']['Representative'])) {
            foreach ($this->data['Vehicle']['Customer']['Representative'] as $rep) {
                $representatives[$rep['id']] = $rep['surname']. ' ' .$rep['name'];
            }
        }
        $this->data['F02']['vehicle_id'] = $this->data['Vehicle']['id'];
        unset($this->data['F02']['id']);
        $types = $this->F02->types;
        $this->set(compact('types', 'representatives'));
    }


    function generar_pdf($id = null) {
        if (empty($id)) {
            $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del formulario 02');
            $this->redirect('/');
        }
        
        $conditions = array('F02.id'=>$id);
        $form = $this->F02->find('first', array(
                'conditions'=> $conditions,
                'contain' => array(
                    'Representative',
                    'Vehicle'=>array('Customer'=>array('CustomerLegal','CustomerNatural','Identification')),
                ),
            ));
        $f02types = $this->F02->types;
        $nationalityTypes = $this->F02->Representative->nationalityTypes;

        $debug_mode = false;
        if (!empty($this->passedArgs['debug'])){
            $debug_mode = true;
        }
        $this->set(compact('form','f02types','nationalityTypes', 'debug_mode'));
    }


    function test(){
        
    }
}
?>
