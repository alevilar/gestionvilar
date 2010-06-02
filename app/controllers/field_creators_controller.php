<?php


class FieldCreatorsController extends AppController {

    var $scaffold;

    var $uses = array('FieldCoordenate');

    var $helpers = array('Fpdf');



    /**
     *
     * @param string $form_model_name modelo del formulario Ej: F02, F12, etc
     * @param integer $vehicle_id id del viehiculo a imprimir
     */
    function addForm($form_model_name, $vehicle_id = null)
    {
        $this->{$form_model_name} = ClassRegistry::init($form_model_name);
        
        if (empty($vehicle_id)) {
            if (empty($this->data[$form_model_name]['vehicle_id'])) {
                $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del vehículo');
                $this->redirect('/');
            } else {
                $vehicle_id = $this->data[$form_model_name]['vehicle_id'];
            }
        }
        $conditions = array($form_model_name .'.vehicle_id'=>$vehicle_id);

        if (!empty($this->data)) {
            if (!$this->{$form_model_name}->save($this->data)) {
                $this->Session->setFlash("no pudo guardarse el formulario $form_model_name");
            } else {
                $this->redirect('generar_pdf/'.$form_model_name.'/'.$this->{$form_model_name}->id.'.pdf');
            }
        } else {
            if (!empty($this->data[$form_model_name]['id'])) {
                $this->{$form_model_name}->id = $this->data[$form_model_name]['id'];
                $conditions = array($form_model_name .'.id'=>$this->{$form_model_name}->id);
            }
        }

        $this->data = $this->{$form_model_name}->find(
                'data', array(
                    'form_id'=>$this->{$form_model_name}->id,
                    'vehicle_id'=>$vehicle_id));

        $representatives = array();
        if (!empty($this->data['Vehicle']['Customer']['Representative'])) {
            foreach ($this->data['Vehicle']['Customer']['Representative'] as $rep) {
                $representatives[$rep['id']] = $rep['surname']. ' ' .$rep['name'];
            }
        }
        $this->data[$form_model_name]['vehicle_id'] = $this->data['Vehicle']['id'];
        unset($this->data[$form_model_name]['id']);
        $modelViewVars = $this->{$form_model_name}->getViewVars();
        $this->set(compact('modelViewVars', 'representatives'));

        $this->render(strtolower('add_' . $form_model_name));
    }


    function generar_pdf($form_model_name, $fxx_id = null) {
       
        if (empty($form_model_name)) {
            $this->Session->setFlash('Formulario inválido. Se debe pasar como 1er parámetro el formulario Ej: "F02"');
            $this->redirect('/');
        }

        if (empty($fxx_id)) {
            $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del formulario');
            $this->redirect('/');
        }

        $fxx = ClassRegistry::init(strtoupper($form_model_name));

        $fxx->generateDataWithFields($fxx_id);


        $debug_mode = false;
        if (!empty($this->passedArgs['debug'])) {
            $debug_mode = true;
        }

        $debug_mode = false;
        if (!empty($this->passedArgs['debug'])){
            $debug_mode = true;
        }

        $this->data = $fxx->fields;

        $this->set('form_name',$form_model_name);
        $this->set('vehicle_domain', $fxx->data['Vehicle']['patente']);
        $this->set(compact('modelViewVars', 'debug_mode'));
    }
    
}
?>
