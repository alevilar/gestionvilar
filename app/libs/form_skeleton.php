<?php

abstract class FormSkeleton extends AppModel
{

    /**
     * Este dato se llena de la tabla field_coordenates de acuerdo al tipo
     * de formulario que se solicite. EL tipo de formulario esta en la tabla field-creators
     * @var array
     */
    var $fieldsPage1 = array(); // ANVERSO
    var $fieldsPage2 = array(); // REVERSO
    /**
     *
     *  Es solo para mstar una columan vacia en la fista addForm del formCreator
     *  es solo util como una cuesion de diseño y es un hack para
     *  que quede lo maslindo y entendible posible
     * @var constant array
     */
    var $COLUMNA_VACIA = array('legend' => '', '-' => array('type' => 'hidden'));
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
    /**
     * Id del formulario que yo quiero generar
     * @var integer
     */
    var $form_id; // este sirve para generar el PDF

    // este sirve para generar la vista del form_add
    var $vehicle_id;

    // array de elementos a mostrar en el formulario de carga para este formulario, justamente.
    // el array es dela forma: array('nombre del elemento'=>array('optiones'))
    var $elements = array(); 
    
    /**
     * Default belongs para tosos los modelos
     * @var array
     */
    var $belongsTo = array('Vehicle', 'Representative');
    /**
     * Lista negra de campos. Son los capos que no quiero que se rendericen automaticaente
     * cuando use el input helper. para mas informacion ver el metodo inpputts del FormHelper
     * @var array
     */
    var $fieldsBlackList = array('modified', 'created');
    /**
     * Son los nombres de los personajes involucrados en el formulario
     * el array es del tipo key -> value donde el key es el string que lo identifica
     * y el value es un titulo o nombre mas legible
     * Ej
     * array('vendedor'=>'Titular vendedor')
     */
    var $involucrados = array();


    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->setSContain();

        if (empty($this->form_id)) {
            debug("No se declaró el ID del formulario, no se puede continuar");
        }
    }

    /**
     * getter de $form_id
     * 
     * @return integer id generado en el Insert en la tabla field_creators
     */
    final public function getFieldCreatorId()
    {
        return $this->form_id;
    }

    /**
     *  Son los capos que seran renderizados en el formulario de ADD del formulario en cuestion
     */
    abstract function getFormImputs($data);

    /**
     * Array de elementos a mostrar en la vista
     */
    public function getElements()
    {
        return $this->elements;
    }

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
    public function setSContain()
    {
        $this->sContain = array(
            'Representative',
            'Vehicle' => array(
                'Customer' => array(
                    'Character' => array('CharacterType'),
                    'Representative',
                    'CustomerLegal',
                    'CustomerNatural' => array('Spouse'),
                    'CustomerHome',
                    'Identification' => array('IdentificationType')
                )
            )
        );
    }

    /**
     * es el find de cake pero para definir segun cada formulario
     * @param string data si es data entonces en fields le paso 1ero el Id del
     * formulario, si no lo encuentra porque aun no esta creado, entonces uso el id del vehiculo
     *
     * @param array fields array('form_id','vehicle_id')
     */
    public function find($conditions = 'data', $fields = array(), $order = null, $recursive = null)
    {
        // este es el find que usan los formularios
        if ($conditions == 'data') {
            if (!empty($this->vehicle_id)) {
                $fields['vehicle_id'] = $this->vehicle_id;
            }

            $cond = array(
                'conditions' => array(
                    $this->name . '.vehicle_id' => $fields['vehicle_id'],
                    $this->name . '.vehicle_id <>' => 0,
                    ),
                'contain' => $this->sContain,
                'order' => array($this->name . '.created DESC')
            );
            $ret = parent::find('first', $cond);
            if (empty($ret)) {
                $ret = $this->Vehicle->find('data', $fields, $order, $recursive);
            } else {
                $ret = $this->Vehicle->acomodarDatosTraidos($ret);
  // AGregar nombre con CUIT si es Clicnte Juridico
//                $nombreCuit = $this->getNombreWidthCuitIfLegal('Customer');
//                $ret['Vehicle']['Customer']['name_n_cuit'] = $nombreCuit;
            }
            $this->data = $ret;
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
    private function loadFormData($id)
    {
        $conditions = array($this->name . '.id' => $id);
        $this->data = $this->find('first', array(
                    'conditions' => $conditions,
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
    public function generateDataWithFields($fxx_id, $data = null)
    {

        // levanto los campos de este tipo de formulario de la tabla de coordenadas
        $this->loadFields();

        // levanto la data del Formulario
        if (empty($data))
            $this->loadFormData($fxx_id);
        else
            $this->data = $data;

        // asigno los valoresque en field_coordenates ya tienen un campo en la tabla del model asignado
        $this->autoPopulateFields();
    }

    private function makePopulation($p)
    {
        if (!empty($p['FieldCoordenate']['related_field_table'])) {
            $campo = $p['FieldCoordenate']['related_field_table'];
            //$formCampoNombre = $p['FieldCoordenate']['name'];
            $fontSize = $p['FieldCoordenate']['font_size'];

            if (!array_key_exists($campo, $this->data[$this->name])) {
                $this->log("no existe el campo $campo para el FieldCreator ID() " . $p['FieldCoordenate']['id']);
                return -1; // el campo no existe como columna del modelo
            }

            if (!empty($p['FieldCoordenate']['continue_field_coordenate_id'])) {
                $arrayCampos = array(
                    'renglones' => array(
                        $p['FieldCoordenate']['name'],
                        $p['FieldContinue']['name']),
                    'field_name' => $this->data[$this->name][trim($campo)]);
                $this->meterNombreCompletoEnVariosRenglones($arrayCampos);
            } else {
                if (!empty($this->data[$this->name][$campo])) {
                    $valor = $this->data[$this->name][$campo];
                } else {
                    $valor = $this->data[$this->name][trim($campo)];
                }
                $this->populateFieldWithValue($p['FieldCoordenate']['id'], $valor, array('fontSize' => $fontSize));
            }
            return 1; // paso OK
        }
        return 0; // esta vacio el campo
    }

    /**
     * Segun lo ingresado en el campo "related_field_table de la tabla field:coordenates
     * voy llenando con los datos guardados en la tabla del formulario para ingresarlos automaticaente al PDF
     *
     */
    function autoPopulateFields()
    {
        $campoFallo = array();
        foreach ($this->fieldsPage1 as $p) {
            if ($this->makePopulation($p) < 0) {
                $campoFallo[] = $p;
            }
        }
        unset($p);
        foreach ($this->fieldsPage2 as $p) {
            if ($this->makePopulation($p) < 0) {
                $campoFallo[] = $p;
            }
        }

        if (count($campoFallo) > 0) {
            foreach ($campoFallo as $c)
            $this->log('fallo al intertar campo en funcion autoPopulateFields');
            debug("el campo <b>".$c['FieldCoordenate']['name']."</b> no existe:");
        }
    }

    /**
     *  aca puedo escribir codigo javascript para ser ejecutado al final de la
     *  vista del formulario ADD_FORM
     *
     * @return string
     *                  EJ:  echo 'var algo=null;';
     */
    function getJavascript()
    {
        echo '';
    }

    /**
     * Setter del atributo fields desde la tabla correspondiente al Model actual
     *
     * @return array de fields
     */
    private function loadFields()
    {
        $this->FieldCoordenate = ClassRegistry::init('FieldCoordenate');
        $id = $this->getFieldCreatorId();


        $this->fieldsPage1 = $this->FieldCoordenate->getCoorFrom($id, 1);

        $this->fieldsPage2 = $this->FieldCoordenate->getCoorFrom($id, 2);
    }

    /**
     * Me devuelve un array con variables que yo luego voy a uqerer mostrar
     * en la vista de alta del formulario.
     * La vista de alta de los formularios son generados en el
     * Controller: field_creators ----  Action: addForm()
     *
     * @param array $elements son variables que yo le puedo mandar a mi getViewVars customizado
     * @return array
     */
    function getViewVars()
    {
        return array();
    }

    /**
     * Dado un campo por su nombre, me introduce el valor en el array fields
     *
     * @param string $fieldCoordenateId es el ID de la tabla field_coordenates. Es el campo al cual yo quiero ponerle un valor
     * @param string $value el valor que quiero que se muestre en el PDF
     * @param array $options
     *                      ['fontSize'] tamaño de la fuente por defaul en 10pt
     *
     * @return integer pagina donde fue encontrada (1 o 2) retorna 0 si no encuentra nada
     *
     */
    function populateFieldWithValue($fieldCoordenateId, $value, $options = array('fontSize' => 10))
    {
        if (empty($fieldCoordenateId))
            return -1;

        foreach ($this->fieldsPage1 as &$f) {
            if (($f['FieldCoordenate']['id'] == $fieldCoordenateId)) {
                $f['FieldCoordenate']['value'] = $value;
                $f['FieldCoordenate']['fontSize'] = $options['fontSize'];
                return 1;
            }
        }
        foreach ($this->fieldsPage2 as &$f) {
            if (($f['FieldCoordenate']['id'] == $fieldCoordenateId)) {
                $f['FieldCoordenate']['value'] = $value;
                $f['FieldCoordenate']['fontSize'] = $options['fontSize'];
                return 2;
            }
        }
        debug("<br>El campo ID de field_coodenates'$fieldCoordenateId' para el valor '$value' no fué encontrado<br>");
        $this->log("$this->name PopulateFieldWidthValue::: El campo ID de field_coordenats n°'$fieldCoordenateId', para el valor '$value' no fué encontrado");
        return 0;
    }

    /**
     * Me inserta el noimbre de un Customer en varios renglones.
     * Si el Customer es Lega, entonces inserta el CUIT con el número
     * este sirve en varios formularios, como el 01 y el 03
     *
     * @param  array  'renglones' => Son los field_coordenates name, en ellos se imprimiran el valor pasado
     *                  string 'field_name'=> Texto a imprimir en esos renglones
     *
     * @param integer $model es el modelo que quiero llenar, puede ser 'Customer' o 'Character'
     */
    function meterNombreCompletoEnVariosRenglonesConCuit($options, $model = 'Customer', $metercuit = true)
    {
        if ($metercuit) {
            $options['field_name'] = $this->getNombreWidthCuitIfLegal($model);
        }
        $this->meterNombreCompletoEnVariosRenglones($options);
    }

    /**
     * Me devuelve el nombre del cliente agregandole el CUIT al final, en caso de ser
     * un cliente juridico. Caso contrario devuelve el string vacio.
     *
     * @param string $model
     * @return string
     */
    function getNombreWidthCuitIfLegal($model)
    {
        $d = $this->data;
        $tName = '';
        if ($model == 'Customer') {
            // NOMBRE   (Si es persona jurídica le tengo que poner el CUIT a lo ultimo del nombre)
            $tName = $d['Vehicle']['Customer']['name'];
            if (!empty($d['Vehicle']['Customer']['Identification']['IdentificationType'])) {
                $tipoYDoc = $d['Vehicle']['Customer']['Identification']['IdentificationType']['name'] . " " . $d['Vehicle']['Customer']['Identification']['number'];

                $tipoId = $d['Vehicle']['Customer']['Identification']['IdentificationType']['id'];
                $tipoYDoc = ($tipoId == 2 || $tipoId == 7 ); // SI ES CUIT o CUIL !! ? $tipoYDoc : '';
                $tName .= " " . $tipoYDoc;
            }
        } else { // model DEL tipo 'Character'
            // NOMBRE   (Si es persona jurídica le tengo que poner el CUIT a lo ultimo del nombre)
            $tName = $d[$model]['name'];
            if (!empty($d[$model]['IdentificationType'])) {
                $tipoYDoc = $d[$model]['IdentificationType']['name'] . " " . $d[$model]['identification_number'];

                $tipoId = $d[$model]['IdentificationType']['id'];
                $tipoYDoc = ($tipoId == 2 || $tipoId == 7 ); // SI ES CUIT o CUIL !! ? $tipoYDoc : '';
                $tName .= " " . $tipoYDoc;
            }
        }
        return $tName;
    }

    /**
     * Meto lo que venga en el string 'field_name' en distintos 'renglones'
     * lo que hace esta funcion es ir agregando palabra a palabra. opara asegurarse que
     * siempre entraran palabras completas y nunca quedaran cortadas.
     *
     * @param array $options
     *                  array  'renglones' => Son los field_coordenates name, en ellos se imprimiran el valor pasado
     *                  string 'field_name'=> Texto a imprimir en esos renglones
     */
    function meterNombreCompletoEnVariosRenglones($options)
    {
        if (empty($options['field_name'])) {
            return -2;
        }

        if (empty($options['renglones'])) {
            $this->log("en metodo meterNombreCompletoEnVariosRenglones no se pasaron los paramentros correctamente");
            debug("no se pasaron los parametros correctamente");
            return -1;
        }

        // preparo el texto en array para recorrerlo y calcular su tamaño
        $vec = explode(" ", $options['field_name']);
        //limpio caracteres nulos
        $newVec = array();
        foreach ($vec as $v) {
            if (!empty($v)) {
                $newVec[] = $v;
            }
        }
        $vec = $newVec;

        // inicializo el FPDF para luego verificar el tamaño de la celda
        App::import('Vendor', 'fpdf/fpdf');
        $orientation = Configure::read('Fpdf.orientation');
        $unit = Configure::read('Fpdf.unit');
        $format = Configure::read('Fpdf.format');
        $fpdfAux = new FPDF();
        $fpdfAux->FPDF($orientation, $unit, $format);
        $fpdfAux->AddPage();

        $field_coord = & ClassRegistry::init('FieldCoordenate');
        foreach ($options['renglones'] as $r) {
            $coordenada = $field_coord->find('first', array(
                        'conditions' => array(
                            'FieldCoordenate.name' => $r,
                            'FieldCoordenate.field_creator_id' => $this->getFieldCreatorId(),
                            )));
            $texto = '';

            // Fuente
            $fpdfAux->SetFont(Configure::read('Fpdf.fontFamily'), '', $coordenada['FieldCoordenate']['font_size']);

            // si oes multicell entonces meto todo el string de una saque eso lo maneja el propio metodo Multicell
            if ($coordenada['FieldCoordenate']['field_type_id'] == 3) { // Multicell
                $texto = implode(" ", $vec);
                $this->populateFieldWithValue($coordenada['FieldCoordenate']['id'], $texto);
                return 1;
            }

            while ($palabra = array_shift($vec)) {
                if (strtoupper($palabra) == 'CUIT' || strtoupper($palabra) == 'CUIL') {
                    $palabra .= " " . array_shift($vec);
                }
                // si el renglon tiene ancho infinito, o sin límite
                if ($coordenada['FieldCoordenate']['w'] == 0) {
                    array_unshift($vec, $palabra);
                    $texto = implode(" ", $vec);
                    $vec = array(); // vacio el array
                }
                if ($coordenada['FieldCoordenate']['w'] >= $fpdfAux->GetStringWidth($texto . " " . $palabra)) {
                    $texto .= " " . $palabra;
                } else {
                    array_unshift($vec, $palabra);
                    break;
                }
            }
            $this->populateFieldWithValue($coordenada['FieldCoordenate']['id'], $texto);
            $texto = ''; // lo vuelvo a inicializar
            if (count($vec) == 0)
                break; // salgo del For renglones

        }
        return 2;
    }

    

    /**
     *
     *  Me llena el $this->data con los datos segun la identificacion
     *  pasada en el Formulario
     *
     * @param string $prefijo nombre del prefijo
     * @return boolean true si metio todo bien, false caso contrario
     */
    function __ponerXPorIdentificationType($prefijo)
    {
        if (!empty($this->data[$this->name][$prefijo . '_identification_type_id'])) {
            switch ($this->data[$this->name][$prefijo . '_identification_type_id']) {
                case 1: //DNI
                    if (!empty($this->data[$this->name][$prefijo . '_nationality_type_id'])) {
                        if ($this->data[$this->name][$prefijo . '_nationality_type_id'] == 'argentino') {
                            $this->data[$this->name][$prefijo . '_identification_dni'] = 'X';
                        } else {
                            $this->data[$this->name][$prefijo . '_identification_dni_ext'] = 'X';
                        }
                    } else {
                        $this->data[$this->name][$prefijo . '_identification_dni'] = 'X';
                    }
                    breaK;
                case 6: // Pasaporte
                    $this->data[$this->name][$prefijo . '_identification_pasap'] = 'X';
                    breaK;
                case 3: // LE
                    $this->data[$this->name][$prefijo . '_identification_le'] = 'X';
                    breaK;
                case 4: // LC
                    $this->data[$this->name][$prefijo . '_identification_lc'] = 'X';
                    breaK;
                case 5: // CI
                    $this->data[$this->name][$prefijo . '_identification_ci'] = 'X';
                    breaK;
                case 2: // CUIT
                    $this->data[$this->name][$prefijo . '_identification_cuit'] = 'X';
                    breaK;
                case 7: // CUIL
                    $this->data[$this->name][$prefijo . '_identification_cuil'] = 'X';
                    breaK;
            }
            return true;
        }
        return false;
    }

    /**
     *
     *  Me llena el $this->data con los datos segun la identificacion
     *  pasada en el Formulario
     *
     * @param string $prefijo nombre del prefijo
     * @return boolean true si metio todo bien, false caso contrario
     */
    function __ponerXPorMaritalStatus($prefijo)
    {
        if (!empty($this->data[$this->name][$prefijo . '_marital_status_id'])) {
            switch ($this->data[$this->name][$prefijo . '_marital_status_id']) {
                case 1: // Casado
                    $this->data[$this->name][$prefijo . '_casado'] = 'X';
                    break;
                case 2: //Soltero
                    $this->data[$this->name][$prefijo . '_soltero'] = 'X';
                    break;
                case 3: // Viudo
                    $this->data[$this->name][$prefijo . '_viudo'] = 'X';
                    break;
                case 4 : // DIvorciado
                    $this->data[$this->name][$prefijo . '_divorciado'] = 'X';
                    break;
            }
            return true;
        }
        return false;
    }

    /**
     *
     *  Me llena el $this->data con los datos segun la identificacion
     *  pasada en el Formulario
     *
     * @param string $prefijo nombre del prefijo
     * @return boolean true si metio todo bien, false caso contrario
     */
    function __ponerXFechaNacimiento($prefijo)
    {
        if (!empty($this->data[$this->name][$prefijo . '_fecha_nacimiento'])) {
            list( $this->data[$this->name][$prefijo . '_dia_nacimiento'],
                    $this->data[$this->name][$prefijo . '_mes_nacimiento'],
                    $this->data[$this->name][$prefijo . '_anio_nacimiento'])
                    = split('[/.-]', $this->data[$this->name][$prefijo . '_fecha_nacimiento']);
            return true;
        }
        return false;
    }


    /**
     * Devuelve un array con el domicilio pedido como parametro
     * @param string $homeType
     * @return array devuelve los datos del model Home
     */
    function getCustomerHome($field,$homeType = null) {
        $homes = $this->getDataFromField('CustomerHome');

        foreach ($homes as $h) {
            if ($h['type'] == $homeType){
                return $h[$field];
            }

            if ($h['type'] == 'Guarda Habitual') {
                return $h[$field];
            }

            if ($h['type'] == 'Legal') {
                debug($h);
                return $h[$field];
            }

            return $h[$field];
        }
    }
    

    /**
     * Devuelve el tipo y numero de documento concatenadaos en un string
     * @return string
     */
    function getTipoYNumero() {
        $model = 'Vehicle.Customer.Identification';
        $tipo = $this->getDataFromField($model, 'identification_type');
        $numero = $this->getDataFromField($model, 'identification_number');
        if (!empty($tipo) && !empty($numero)) {
           $tyn =   $tipo.' '.$numero;
        } else {
            $tyn = $this->getDataFromField('Vehicle.Customer', 'cuit_cuil');
        }
        return $tyn;
    }



    /**
     *  Es un atajo para el $this->data['Model']['field'] con esta funcion me aseguro
     * que si el Model o el field no existen, que no me tire un error PHP de INVALID KEY
     * 
     * @param string $model
     * @param string $field
     * @return String
     */
    function getDataFromField($model, $field = null){
        $retu = "";
        $vData = $this->data;
        
        if (strstr($model, 'Vehicle') === false && empty($vData[$model])) {
            $model = 'Vehicle.Customer.'.$model;
            
        }
        
        $modelsss = explode('.', $model);
        $model = end($modelsss);
        
        foreach ($modelsss as $m ) {
            if (empty($vData[$m])) break;
            $vData = $vData[$m];
        }
        if (empty($field)) return $vData;

        if (empty ($field)) {
            return $vData[$model];
        }
        
        if ( empty($retu) && !empty($vData[$field]) ) {
            return $vData[$field];
        }

        if ( empty($retu) && !empty($vData[$this->name][$field]) ) {
            return $vData[$this->name][$field];
        }

        if ( empty($retu) && !empty($vData[$model][$field]) ) {
            return $vData[$model][$field];
        }
    }


    /**
     *
     *  Me llena el $this->data con los datos segun la identificacion
     *  pasada en el Formulario
     *
     * @param string $prefijo nombre del prefijo
     * @return boolean true si metio todo bien, false caso contrario
     */
    function __ponerXPorFechaInscripcion($prefijo)
    {
        if (!empty($this->data[$this->name][$prefijo . '_fecha_inscripcion'])) {
            list( $this->data[$this->name][$prefijo . '_dia_inscripcion'],
                    $this->data[$this->name][$prefijo . '_mes_inscripcion'],
                    $this->data[$this->name][$prefijo . '_anio_inscripcion'])
                    = split('[/.-]', $this->data[$this->name][$prefijo . '_fecha_inscripcion']);
            return true;
        }
        return false;
    }

//    function __ponerPorcentajeConEnteroYDecimal($inv) {
//         if (!empty( $this->data[$this->name][$prefijo.'_porcentaje'])) {
//             $porcentaje = $this->data[$this->name][$prefijo.'_porcentaje'];
//             $tEntero = (int)$porcentaje;
//             $tDecimal = (int)(($porcentaje-$tEntero)*100);
//             $this->data[$this->name][$prefijo.'_dia_inscripcion'],
//             $this->data[$this->name][$prefijo.'_dia_inscripcion'],
//         }
//    }


    function __autoCompletarElFormData()
    {
        foreach ($this->involucrados as $invTitle) {
            $this->__ponerXPorIdentificationType($invTitle);
            $this->__ponerXPorMaritalStatus($invTitle);
            $this->__ponerXFechaNacimiento($invTitle);
            $this->__ponerXPorFechaInscripcion($invTitle);
        }
    }

    public function beforeSave($options)
    {
        $this->__autoCompletarElFormData();
        return parent::beforeSave($options);
    }

    public function __preformTipo1($involucrado, $legend = null)
    {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $legenda = empty($legend) ? $this->involucrados[$involucrado] : $legend;

        return array(
            'legend' => $legenda,
            $involucrado . '_porcentaje' => array('label' => array('text' => 'Porcentaje (%) ', 'style' => 'float:left; margin-top: 6px;')),
            $involucrado . '_cuit_cuil' => array('label' => 'CUIT o CUIL'),
            $involucrado . '_name' => array('label' => 'Apellido y Nombre o Denominación', 'class' => 'nombre_con_cuit'),
            $involucrado . '_ocupation' => array('label' => 'Profesión'),
            $involucrado . '_calle' => array('label' => 'Calle'),
            $involucrado . '_numero_calle' => array('label' => 'Número'),
            $involucrado . '_piso' => array('label' => 'Piso'),
            $involucrado . '_depto' => array('label' => 'Dep'),
            $involucrado . '_cp' => array('label' => 'Código Postal'),
            $involucrado . '_localidad' => array('label' => 'Localidad'),
            $involucrado . '_departamento' => array('label' => 'Partido o Departamento'),
            $involucrado . '_provincia' => array('label' => 'Provincia'),
            $involucrado . '_identification_type_id' => array('label' => 'Tipo de identificación', 'empty' => 'Seleccione', 'options' => $identificationsTypes),
            $involucrado . '_identification_number' => array('label' => 'N° Documento'),
            $involucrado . '_nationality_type_id' => array('label' => 'Nacionalidad', 'options' => $nationalities, 'empty'=>'Seleccione'),
            $involucrado . '_identification_authority' => array('label' => 'Autoridad (o país) que lo expidió'),
            $involucrado . '_fecha_nacimiento' => array('label' => 'Fecha de Nacimiento', 'type' => 'text'),
            $involucrado . '_marital_status_id' => array('label' => 'Estado Civil', 'options' => $maritalStatus, 'empty' => 'Seleccione'),
            $involucrado . '_nupcia' => array('label' => 'Nupcia'),
            $involucrado . '_conyuge' => array('label' => 'Apellido y nombres del cónyuge'),
            $involucrado . '_personeria_otorgada' => array('label' => 'personeria otorgada por'),
            $involucrado . '_inscripcion' => array('label' => 'N° o datos de inscripción o creación'),
            $involucrado . '_fecha_inscripcion' => array('label' => 'Fecha de inscripción o creación', 'type' => 'text'),
            $involucrado . '_persona_fisica_o_juridica' => array('type' => 'hidden'),
        );
    }

    public function __preformTipo2($involucrado, $legend = null)
    {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $legenda = empty($legend) ? $this->involucrados[$involucrado] : $legend;
        return array(
            'legend' => $legenda,
            $involucrado . '_porcentaje' => array('label' => array('text' => 'Porcentaje (%) ', 'style' => 'float:left; margin-top: 6px;')),
            $involucrado . '_name' => array('label' => 'Apellido y Nombre o Denominación'),
            $involucrado . '_identification_type_id' => array('label' => 'Tipo de identificación', 'empty' => 'Seleccione', 'options' => $identificationsTypes),
            $involucrado . '_identification_number' => array('label' => 'N° Documento'),
            $involucrado . '_nationality_type_id' => array('label' => 'Nacionalidad', 'options' => $nationalities, 'empty'=>'Seleccione'),
            $involucrado . '_identification_authority' => array('label' => 'Autoridad (o país) que lo expidió'),
            $involucrado . '_marital_status_id' => array('label' => 'Estado Civil', 'options' => $maritalStatus, 'empty' => 'Seleccione'),
            $involucrado . '_nupcia' => array('label' => 'Nupcia'),
            $involucrado . '_conyuge' => array('label' => 'Apellido y nombres del cónyuge'),
            $involucrado . '_conyuge_apoderado_name' => array('label' => 'Apellido y nombres del cónyuge'),
            $involucrado . '_conyuge_apoderado_identification_type_id' => array('label' => 'Tipo de identificación', 'empty' => 'Seleccione', 'options' => $identificationsTypes),
            $involucrado . '_conyuge_apoderado_identification_number' => array('label' => 'N° Documento'),
            $involucrado . '_conyuge_apoderado_nationality_type' => array('label' => 'Nacionalidad', 'options' => $nationalities, 'empty'=>'Seleccione'),
            $involucrado . '_conyuge_apoderado_identification_auth' => array('label' => 'Autoridad (o país) que lo expidió'),
            $involucrado . '_apoderado_name' => array('label' => 'Apellido y nombres del Apoderado'),
            $involucrado . '_fecha_sello' => array('label' => 'Fecha, Sello y firma del certificante'),
        );
    }

    public function __representativePreform($involucrado, $legend = null)
    {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;

        $legenda = empty($legend) ? $this->involucrados[$involucrado] : $legend;

        return array(
            'legend' => $legenda,
            $involucrado . '_apoderado_name' => array('label' => 'Apellido y nombres del Apoderado'),
            $involucrado . '_apoderado_identification_type_id' => array('label' => 'Tipo de identificación', 'empty' => 'Seleccione', 'options' => $identificationsTypes),
            $involucrado . '_apoderado_identification_number' => array('label' => 'N° Documento',),
            $involucrado . '_apoderado_nationality_type' => array('label' => 'Nacionalidad', 'options' => $nationalities, 'empty'=>'Seleccione'),
            $involucrado . '_apoderado_nationality' => array('label' => 'Autoridad (o país) que lo expidió'),
            $involucrado . '_fecha_sello',
        );
    }

    function __vehiclePreform1($legend = null)
    {
        $legenda = empty($legend) ? '"F" Vehículo que se tansfiere' : $legend;

        return array(
            'legend' => $legenda,
            'vehicle_id' => array('type' => 'hidden', 'value' => $this->data['Vehicle']['id']),
            'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->data['Vehicle']['patente']),
            'vehicle_brand' => array('label' => 'Marca', 'value' => $this->data['Vehicle']['brand']),
            'vehicle_type' => array('label' => 'Tipo', 'value' => $this->data['Vehicle']['type']),
            'vehicle_model' => array('label' => 'Modelo', 'value' => $this->data['Vehicle']['model']),
            'vehicle_motor_brand' => array('label' => 'Marca del Motor', 'value' => $this->data['Vehicle']['motor_brand']),
            'vehicle_motor_number' => array('label' => 'N° de Motor', 'value' => $this->data['Vehicle']['motor_number']),
            'vehicle_chasis_brand' => array('label' => 'Marca del Chasis', 'value' => $this->data['Vehicle']['chasis_brand']),
            'vehicle_chasis_number' => array('label' => 'N° de Chasis', 'value' => $this->data['Vehicle']['chasis_number']),
            'vehicle_use' => array('label' => 'N° de Chasis', 'value' => $this->data['Vehicle']['use']),
        );
    }

    function __vehiclePreform2($legend = null)
    {
        $legenda = empty($legend) ? __('Vehicle', true) : $legend;
 
        return array(
            'legend' => $legenda,
            'vehicle_id' => array('type' => 'hidden', 'value' => $this->data['Vehicle']['id']),
            'vehicle_patente' => array('label' => 'Dominio', 'value' => $this->data['Vehicle']['patente']),
            'vehicle_fabrication_certificate' => array('label' => 'Certificado de fabricación', 'value' => $this->data['Vehicle']['fabrication_certificate']),
            'vehicle_brand' => array('label' => 'Marca', 'value' => $this->data['Vehicle']['brand']),
            'vehicle_type' => array('label' => 'Tipo', 'value' => $this->data['Vehicle']['type']),
            'vehicle_model' => array('label' => 'Modelo', 'value' => $this->data['Vehicle']['model']),
            'vehicle_motor_brand' => array('label' => 'Marca del Motor', 'value' => $this->data['Vehicle']['motor_brand']),
            'vehicle_motor_number' => array('label' => 'N° de Motor', 'value' => $this->data['Vehicle']['motor_number']),
            'vehicle_chasis_brand' => array('label' => 'Marca del Chasis', 'value' => $this->data['Vehicle']['chasis_brand']),
            'vehicle_chasis_number' => array('label' => 'N° de Chasis', 'value' => $this->data['Vehicle']['chasis_number']),
            'vehicle_use' => array('label' => 'N° de Chasis', 'value' => $this->data['Vehicle']['use']),
            'vehicle_adquisition_value' => array('label' => 'Valor de adquisición', 'value' => $this->data['Vehicle']['adquisition_value']),
            'vehicle_adquisition_dia' => array('div' => array('class' => 'span-1'), 'class' => 'span-1', 'label' => 'Día', 'value' => date('d', strtotime($this->data['Vehicle']['adquisition_date']))),
            'vehicle_adquisition_mes' => array('div' => array('class' => 'span-1'), 'class' => 'span-1', 'label' => 'Mes', 'value' => date('m', strtotime($this->data['Vehicle']['adquisition_date']))),
            'vehicle_adquisition_anio' => array('div' => array('class' => 'span-1'), 'class' => 'span-1', 'label' => 'Año', 'value' => date('y', strtotime($this->data['Vehicle']['adquisition_date']))),
            'vehicle_adquisition_evidence_element' => array('label' => 'Elemento provatorio de la adquisición', 'value' => $this->data['Vehicle']['adquisition_evidence_element']),
        );
    }

}

?>
