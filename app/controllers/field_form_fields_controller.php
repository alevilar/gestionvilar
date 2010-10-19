<?php


class FieldFormFieldsController extends AppController
{

    var $helpers = array('Fpdf');

    var $name = 'FieldFormFields';

    function index()
    {
        $this->FieldFormField->recursive = 0;
        $this->set('fieldFormFields', $this->paginate());
    }

    function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'field form field'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('fieldFormField', $this->FieldFormField->read(null, $id));
    }

    function add($form_creator_id = null, $vehicle_id = null)
    {
        if (!empty($this->data)) {
            debug($this->data['FieldForm']);
            if($this->FieldFormField->FieldForm->save($this->data['FieldForm'])) {
                foreach($this->data['FieldFormField'] as &$fff) {
                    $fff['field_form_id'] = $this->FieldFormField->FieldForm->id;
                }
                if ($this->FieldFormField->saveAll($this->data['FieldFormField'])) {
                    $url = 'generar_pdf/'.$this->data['Info']['printer_id'].'/'.$this->FieldFormField->FieldForm->id.'.pdf';
                    $this->redirect($url);
                } else {
                    $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field form field'));
                }
            } else {
                debug($this->FieldFormField->FieldForm->validationErrors);
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field form'));
            }
        } else {
            $this->data['FieldForm']['vehicle_id'] = $vehicle_id;
            $this->data['FieldForm']['field_creator_id'] = $form_creator_id;
            $formSave = array(
                'form_creator_id' => $form_creator_id,
                'vehicle_id' => $vehicle_id,
            );
            if ($this->FieldFormField->FieldForm->save($formSave)) {
                $fields = $this->FieldFormField->FieldCoordenate->find('all', array(
                            'recursive' => -1,
                            'conditions' => array(
                                'FieldCoordenate.field_creator_id' => $form_creator_id,
                            )
                        ));
                $this->set('field_form_id', $this->FieldFormField->FieldForm->id);

                $contain = array(
                                'Customer'=>array(
                                        'Character'=>array('CharacterType'),
                                        'Representative',
                                        'CustomerLegal',
                                        'CustomerNatural'=>array('Spouse'),
                                        'CustomerHome',
                                        'Identification'=>array('IdentificationType')
                                )
                        );
                $customer = $this->FieldFormField->FieldForm->Vehicle->find('data', array(
                    'vehicle_id' => $vehicle_id
                ));
                $this->data = $customer;
                $this->data['FieldForm']['vehicle_id'] = $vehicle_id;
                $this->data['FieldForm']['field_creator_id'] = $form_creator_id;

                $this->set('printers', ClassRegistry::init('Printer')->find('list'));
                $this->set(compact('fields'));
            }
        }
    }


    function generar_pdf($printer_id, $fxx_id)
    {
         $this->Printer =& ClassRegistry::init('Printer');
        $this->Printer->id = $printer_id;
        $printer = $this->Printer->read();

        if (empty($fxx_id)) {
            $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del formulario');
            $this->redirect('/');
        }

        $fieldsPage1 = $this->FieldFormField->getCoorFrom($fxx_id, 1);
        $fieldsPage2 = $this->FieldFormField->getCoorFrom($fxx_id, 2);

        //        debug($fxx->data);
        //        debug($fxx->fieldsPage1);

        $debug_mode = false;
        if (!empty($this->passedArgs['debug'])) {
            $debug_mode = true;
        }

        $pages = array($fieldsPage1, $fieldsPage2);

        $this->set('form_name', $fxx_id);
        
        $this->set('vehicle_domain', 'autoform');
        $this->set(compact('debug_mode', 'pages', 'printer'));

        // debug($page1);//die("terminarlo");
    }

    function edit($id = null)
    {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'field form field'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->FieldFormField->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field form field'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field form field'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->FieldFormField->read(null, $id);
        }
        $fieldForms = $this->FieldFormField->FieldForm->find('list');
        $fieldCoordenates = $this->FieldFormField->FieldCoordenate->find('list');
        $this->set(compact('fieldForms', 'fieldCoordenates'));
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'field form field'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->FieldFormField->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'Field form field'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Field form field'));
        $this->redirect(array('action' => 'index'));
    }

}

?>