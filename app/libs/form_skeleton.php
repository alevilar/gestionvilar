<?php

abstract class FormSkeleton extends AppModel {
    /**
     * Este dato se llena de la tabla field_coordenates de acuerdo al tipo
     * de formulario que se solicite. EL tipo de formulario esta en la tabla field-creators
     * @var array
     */
    var $fields = array();

    /**
     * Esta variable sirve para llenar con lo datos del formulario a imprimir
     * los datos se crean en el formulario addForm, paraluego ser procesaod
     * y generados en PDF.
     * @var array
     */
    var $data = array();

    /**
     *
     * Es un array con el contain del behaiviur Containable
     * sirve para que cada modelo del formulario traiga lo que le compete
     * @var array
     */
    var $sContain = array();

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->setSContain();

    }

    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    abstract public function getFieldCreatorId();


    /**
     * Me mapea la data del formulario para cada field
     * utiliza los atributos this->data y this->fields
     * esto hay que redefinirlo para cada formulario
     */
    abstract function mapData();



    /**
     * Es el setter del atributo $sContain
     * sirve para realizar las busquedas y se ejecuta en el constructor
     *
     * para que la busqueda trauga TODO habria que copiar este array:
     *                    array(
     'Customer'=>array(
     'Representative',
     'CustomerHome',
     'CustomerLegal',
     'CustomerNatural'=>array('Spouse'),
     'Identification'=>array('IdentificationType')
     )
     )
     */
    abstract function setSContain();



    /**
     * es el find de cake pero para definir segun cada formulario
     * @param string data si es data entonces en fields le paso 1ero el Id del
     * formulario, si no lo encuentra porque aun no esta creado, entonces uso el id del vehiculo
     *
     * @param array fields array('form_id','vehicle_id')
     */
    public function find($conditions = 'data', $fields = array(), $order = null, $recursive = null) {
        if ($conditions == 'data') {
            $cond = array(
                    'conditions'=> array($this->name . '.vehicle_id'=>$fields['vehicle_id']),
                    'contain' => $this->sContain,
                    'order'=> array($this->name.'.created DESC')
            );

            $ret =  parent::find('first', $cond);


            if (empty($ret)) {
                $ret = $this->Vehicle->find('first', array(
                        'conditions'=> array('Vehicle.id'=>$fields['vehicle_id']),
                        'contain' => $this->sContain['Vehicle']['Customer'],
                ));
            }
            if (!empty($ret['Customer'])) {
                $ret['Vehicle']['Customer'] = $ret['Customer'];
            }
        } else {
            $ret = parent::find($conditions, $fields, $order, $recursive);
        }
        return $ret;
    }

    /**
     *
     * Me carga la data de un formulario. La que yo previamente guarde con el addForm
     * Este metodo hay que refefinirlo para cada formulario porque hay que traer
     * loos campos que el formulario requiera
     *
     * @param integer $id  id de la tabla del formulario en cuestion.
     * Por ejemplo si estamos en la tabla f02s, o f12s, o f01s,
     * es el Id del registro de cada una de las tablas
     */
    private function loadFormData($id) {
        $conditions = array($this->name.'.id'=>$id);
        $this->data = $this->find('first', array(
                'conditions'=> $conditions,
                'contain' => $this->sContain,
        ));
    }



    /**
     * Me ejecuta los campos 'fields' y los mezcla con la data
     * asignandole un KEY llamado 'value' con el contenido al array de fields
     * de esta manera, voy llenando con los string que luego imprimire en pantalla
     * en la posicion que los fields digan.
     *
     * para que esto funcione primero hay que llenar los fields con loadFields
     * y loadFormData.
     *
     * luego hay que settear las equivalencias de strings a manopla,
     * que se hace redefiniendo mapData()
     *
     * @param integer $fxx_id id del formulario que quiero cargar la data
     */
    public function generateDataWithFields($fxx_id) {
        // levanto los campos de este tipo de formulario de la tabla de coordenadas
        $this->loadFields();

        // levanto la data del Formulario
        $this->loadFormData($fxx_id);

        // setteo los valores
        $this->mapData();
    }




    /**
     * Setter del atributo fields desde la tabla correspondiente al Model actual
     *
     * @return array de fields
     */
    private function loadFields() {
        $this->FieldCoordenate = ClassRegistry::init('FieldCoordenate');
        $this->FieldCoordenate->recursive = -1;
        $id = $this->getFieldCreatorId();
        $fields = $this->FieldCoordenate->find('all', array(
                'conditions'=>array('FieldCoordenate.field_creator_id'=>(int)$id),
                'contain'=>array('FieldType')
        ));
        return $this->fields = $fields;
    }

    /**
     * Me devuelve un array con variables que yo luego voy a uqerer mostrar
     * en la vista de alta del formulario.
     * La vista de alta de los formularios son generados en el
     * Controller: field_creators ----  Action: addForm()
     *
     * @return array
     */
    public function getViewVars() {
        return array();
    }


    /**
     * Dado un campo por su nombre, me introduce el valor en el array fields
     *
     * @param string $fieldname es el campo "name" de la tabla field_coordenates. Es el campo al cual yo quiero ponerle un valor
     * @param string $value el valor que quiero que se muestre en el PDF
     * @return <type>
     */
    function populateFieldWithValue($fieldname, $value) {
        foreach ($this->fields as &$f) {
            if(($f['FieldCoordenate']['name'] == $fieldname)) {
                $f['FieldCoordenate']['value'] = $value;
                break;
            }
        }
    }



}

?>
