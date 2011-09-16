<?php

class FieldCreatorsController extends AppController {

    var $name = 'FieldCreators';
    var $uses = array('FieldCreator', 'FieldCoordenate', 'Printer');
    var $helpers = array('Fpdf', 'Mpdf');

    function test() {
        
    }


    function campos_repetidos() {
        $query = "
            SELECT f.name, a.related_field_table, b.id , a.*
            FROM field_coordenates a, field_coordenates b
            left join field_creators f on f.id = b.field_creator_id
            WHERE
            a.field_creator_id = b.field_creator_id
            and a.related_field_table <> ''
            AND a.related_field_table = b.related_field_table
            AND a.id <> b.id
            order by a.field_creator_id, a.related_field_table;
            ";
        ;
        $this->set('res', $this->FieldCreator->query($query) );
    }

    function index() {
        $this->FieldCreator->recursive = 0;
        $this->set('fieldCreators', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid %s', true), 'field creator'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('fieldCreator', $this->FieldCreator->read(null, $id));
    }

    function add() {
       $this->redirect('edit');
    }

    function edit($id = null) {
        if (!empty($this->data)) {
            if ($this->FieldCreator->save($this->data)) {
                $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'field creator'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'field creator'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->FieldCreator->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'field creator'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->FieldCreator->delete($id)) {
            $this->Session->setFlash(sprintf(__('%s deleted', true), 'Field creator'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Field creator'));
        $this->redirect(array('action' => 'index'));
    }



    function deleteForm($form = null,$id = null) {
        if (!$id || !$form) {
            $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'éste formulario'));
        }
        if ($formName =& ClassRegistry::init($form)) {
            $formName->recursive = -1;
            if ($formName->delete($id, false)) {
                $this->Session->setFlash(sprintf(__('%s deleted', true), 'Formulario'));
            } else {
                debug($formName);die;
                $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'El Formulario'));
            }
        } else {
            $this->Session->setFlash("El formulario '$form' no existe");
        }
        $this->redirect($this->referer());
    }
    

    /**
     *
     * @param string $form_model_name modelo del formulario Ej: F02, F12, etc
     * @param integer $vehicle_id id del viehiculo a imprimir
     */
    function addForm($form_model_name, $vehicle_id = null) {
        $vehicleName = '';
        $this->FieldCreator->recursive = -1;
        $modelName = $this->FieldCreator->findByModel($form_model_name);
        

        if ($this->{$form_model_name} = ClassRegistry::init($form_model_name)) {

            // verifico que el modelo herede de la clase FormSkeleton
            if (get_parent_class($this->{$form_model_name}) != 'FormSkeleton') {
                debug("ERROR !!!!! ::::::: La clase del formulario no extiende de FormSkeleton !!!! por eso es que se ven errores");
                die('Error: El formulario debe extender de FormSkeleton');
            }

            // settear el id del vehiculo
            if (!empty($vehicle_id)){
                $this->{$form_model_name}->vehicle_id = $vehicle_id;
            }
         
            if (!empty($this->data)) {
                //debug($this->data);
                unset($this->{$form_model_name}->data);
               // debug($this->{$form_model_name});
                if (!$this->{$form_model_name}->save($this->data[$this->{$form_model_name}->name])) {
                    $this->Session->setFlash("no pudo guardarse el formulario $form_model_name");
                } else {
                    // GENERO EL PDF
                    $this->redirect('generar_pdf/' . $this->data[$form_model_name]['printer_id'] . '/' . $form_model_name . '/' . $this->{$form_model_name}->id . '.pdf');
                }
            }

            if (!empty($this->data[$form_model_name]['id'])) {
                $this->{$form_model_name}->id = $this->data[$form_model_name]['id'];
            }

//debug($this->data);
            if (!empty($vehicle_id)){
                
                 $this->data = $this->{$form_model_name}->find('data', array(
                            'form_id' => $this->{$form_model_name}->id,
                            'vehicle_id' => $vehicle_id)
                );

                $this->data[$form_model_name]['vehicle_id'] = $this->data['Vehicle']['id'];
                
            }
            // si el formulario fue creado hace menos de1 hora, en vez de hacer un INSERT quiero un UPDATE
            // para ello elimino el ID del formulario
            if (!empty($this->data[$form_model_name]['created'])) {
                if ($this->data[$form_model_name]['created'] > date('Y-m-d H:i:s', strtotime('-1 hour'))) {
                    unset($this->data[$form_model_name]['id']);
                }
            }

            // meto en la vista las variables
            $modelViewVars = $this->{$form_model_name}->getViewVars();
            foreach ($modelViewVars as $varName => $varValue) {
                $this->set($varName, $varValue);
            }
            
            @$vehicleName = '::[ '.$this->data['Vehicle']['patente']. ' ] '.$this->data['Vehicle']['Customer']['name'];
            $this->set('title_for_layout', 'F '.$modelName['FieldCreator']['name'].$vehicleName);
            $this->set('formBlackList', $this->{$form_model_name}->fieldsBlackList);
            $this->set('formInputs'   , $this->{$form_model_name}->getFormImputs($this->data));
            $this->set('formName'     , $form_model_name);
            $this->set('writeJavascript', $this->{$form_model_name}->getJavascript());
            $this->set('elements'     , $this->{$form_model_name}->getElements());
            $this->set('printers'     , $this->Printer->find('list'));

        }

        //$this->render(strtolower('add_' . $form_model_name));
    }

    function testForm() {
        if (empty($this->data)) {
            $printers = $this->Printer->find('list');
            $forms = $this->FieldCreator->find('list');
            $this->set(compact('printers', 'forms'));
        } else {
            $this->layout = 'pdf/default';
            $page1 = $this->FieldCreator->FieldCoordenate->getCoorFrom($this->data['FieldCreator']['form_id'],1);
            foreach ($page1 as &$c) {
                $c['FieldCoordenate']['value'] = empty($c['FieldCoordenate']['test_print_text']) ? $c['FieldCoordenate']['name'] : $c['FieldCoordenate']['test_print_text'];
            }

            $page2 = $this->FieldCreator->FieldCoordenate->getCoorFrom($this->data['FieldCreator']['form_id'],2);
            foreach ($page2 as &$c) {
                $c['FieldCoordenate']['value'] = empty($c['FieldCoordenate']['test_print_text']) ? $c['FieldCoordenate']['name'] : $c['FieldCoordenate']['test_print_text'];
            }

            $modelViewVars = array();
            $printer = $this->Printer->read(null, $this->data['FieldCreator']['printer_id']);

            $pages = array($page1, $page2);
            //debug($pages);
            $this->set('form_name', 'formulario_de_prueba');
            $this->set('vehicle_domain', '');
            $this->set('debug_mode', $this->data['FieldCreator']['debug']);
            $this->set(compact('modelViewVars', 'pages', 'printer'));

            $this->render(null, null, 'pdf/generar_pdf');
        }
    }

    function generar_pdf($printer_id, $form_model_name, $fxx_id = null) {
        $this->Printer->id = $printer_id;
        $printer = $this->Printer->read();
        
        if (empty($form_model_name)) {
            $this->Session->setFlash('Formulario inválido. Se debe pasar como 1er parámetro el formulario Ej: "F02"');
           // $this->redirect('/');
        }

        if (empty($fxx_id)) {
            $this->Session->setFlash('Id inválido. Se debe pasar como parámetro el Id del formulario');
         //   $this->redirect('/');
        }

        /* @var $fxx FormSkeleton */
        $fxx = ClassRegistry::init($form_model_name);
        $fxx->generateDataWithFields($fxx_id);

        $debug_mode = false;
        if (!empty($this->passedArgs['debug'])) {
            $debug_mode = true;
        }

        $pages = $fxx->fieldsPage;
        $this->set('form_name', $form_model_name);
        $this->set('vehicle_domain', $fxx->data['Vehicle']['patente']);
        $this->set(compact('modelViewVars', 'debug_mode', 'pages', 'printer'));

    }



        function creadorDeCamposForm() {

           $modelos = $this->FieldCreator->find('list');

           $this->set('modelos', $modelos);

        }


        function creadorDeCamposSubmit() {

            if (empty($this->data)) {
                debug("No puede venir el this->data vacio");
                $this->Session->setFlash('Vinieron datos vacios del formulario... no hay nada que hacer');
                exit;
            }

//            $this->FieldCreator->contain(array(
//                'FieldCoordenates'
//            ));
            $this->FieldCreator->id = $this->data['FieldCreator']['id'];
            $fctr = $this->FieldCreator->read();

                //traer campos dela tabla coordenates para el formulario seleccionado
                $fieldCoords = $fctr['FieldCoordenates'];

                // taer lainstancia dl formulario (Modelo) seleccionado
                /* @var $form FormSkeleton */
                $form =& ClassRegistry::init($fctr['FieldCreator']['model']);


                //taer el schema del Modelo seleccionado
                $form->_schema();

                //comparar los campos con el schema
//                foreach ($fieldCoords as $fc) {
//                    if
//                }

                // si falta alguun campo, entyonces hay que hacer el alter table

        }


        function model_creation($id){
            /* @var $session SessionComponent */
                $session =& $this->Session;
            if (empty($id)) {                
                $session->setFlash('debe pasar un ID como parámetro');
                $this->redirect('/');
            }
            
            if ($this->FieldCreator->crearTabla($id) > 0) {
                $mensaje = 'Se ha creado la tabla correctamente';
                
            } else {
                $mensaje = 'Error al crear la tabla';
            }
            $session->setFlash($mensaje);
            $this->redirect('index');
        }

        function model_update($id){
            $res = $this->FieldCreator->actualizarTabla($id);
            if ( count($res) > 0) {
                $sacados = $agregados = '';
                if (!empty($res['added'])) $agregados = 'Agregados: '.implode(', ',$res['added']);
                if (!empty($res['dropped'])) $sacados = 'Sacados: '.implode(', ',$res['dropped']);
                $mensaje = "Se ha actualizado la tabla correctamente. <br>$sacados<br> $agregados";
                $mensaje .= "<br>";
                $mensaje .= $this->FieldCreator->querytxt;

            } else {
                $mensaje = 'La tabla no se actualizó. No hay campos que actualizar';
            }
            $this->flash($mensaje, 'index');
        }
}

?>