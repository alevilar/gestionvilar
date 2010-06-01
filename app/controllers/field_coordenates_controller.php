<?php
class FieldCoordenatesController extends AppController {

    var $name = 'FieldCoordenates';
    var $scaffold;

/**
 *
 * Me genera el pdf de cualquier formulario automaticamente
 * 
 * @param integer $form_creator_id id del tipo de formulario EJ: F02, F03, F12, etc. tabla field_creators
 * @param integer $fxx_id id del formulario, esta en la tabla que $form_creator dice, o sea, es el ID dentro de la tabla f02s, f03s,. f12s, etc
 */
    function generar($form_creator_id, $fxx_id) {
        
        if (empty($form_creator_id)) {
            $this->Session->setFlash('Formulario inválido. Se debe pasar como 1er parámetro el formulario Ej: "F02"');
            $this->redirect('/');
        }

        if (empty($fxx_id)) {
            $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del formulario');
            $this->redirect('/');
        }

        $this->FieldCoordenate->FieldCreator->id = $form_creator_id;
        $form = $this->FieldCoordenate->FieldCreator->read();
        $fxx = ClassRegistry::init('F' . $form['FieldCreator']['name']);

        $conditions = array('F'. $form['FieldCreator']['name'] .'.id'=>$fxx_id);
        $this->data = $fxx->find('first', array(
                'conditions'=> $conditions,
                'contain' => array(
                        'Representative',
                        'Vehicle'=>array(
                            'Customer'=>array(
                                'CustomerLegal',
                                'CustomerNatural'=>array('Spouse'),
                                'Identification'=>array('IdentificationType'),
                                'CustomerHome',
                            )
                        ),
                ),
        ));

        $this->FieldCoordenate->recursive = -1;
        $fields = $this->FieldCoordenate->find('all', array(
            'conditions'=>array('FieldCoordenate.field_creator_id'=>(int)$form_creator_id),
        ));

        $debug_mode = false;
        if (!empty($this->passedArgs['debug'])) {
            $debug_mode = true;
        }
        debug($fields);
        //die();
        $this->set(compact('$fields'));




    }
}
?>