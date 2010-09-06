<?php


abstract class FormSkeleton extends AppModel {
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
    var $COLUMNA_VACIA =  array('legend'=>'', '-'=> array('type'=>'hidden'));

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
    var $vehicle_id; // este sirve para generar la vista del form_add
    var $elements = array(); // array de elementos a mostrar en el formulario de carga para este formulario, justamente.
                             // el array es dela forma: array('nombre del elemento'=>array('optiones'))

    /**
     * Default belongs para tosos los modelos
     * @var array
     */
    var $belongsTo = array('Vehicle','Representative');


    /**
     * Lista negra de campos. Son los capos que no quiero que se rendericen automaticaente
     * cuando use el input helper. para mas informacion ver el metodo inpputts del FormHelper
     * @var array
     */
    var $fieldsBlackList = array('modified', 'created');


    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->setSContain();

        if (empty($this->form_id)) {
            debug("No se declaró el ID del formulario, no se puede continuar");
        }

    }

    /**
     *
     * @return integer id generado en el Insert en la tabla field_creators
     */
    final public function getFieldCreatorId(){
        return $this->form_id;
    }
    

    /**
     *  Son los capos que seran renderizados en el formulario de ADD del formulario en cuestion
     */
    abstract function getFormImputs($data);


/**
 * Array de elementos a mostrar en la vista
 */
    public function getElements(){
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
    public function setSContain(){
        $this->sContain = array(
                'Representative',
                'Vehicle' => array(
                        'Customer'=>array(
                                'Character'=>array('CharacterType'),
                                'Representative',
                                'CustomerLegal',
                                'CustomerNatural'=>array('Spouse'),
                                'CustomerHome',
                                'Identification'=>array('IdentificationType')
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
    public function find($conditions = 'data', $fields = array(), $order = null, $recursive = null) {
        
        if (!empty($this->vehicle_id)) {
            $fields['vehicle_id'] = $this->vehicle_id;
        }
        // este es el find que usan los formularios
        if ($conditions == 'data') {
            $cond = array(
                    'conditions'=> array($this->name . '.vehicle_id'=>$fields['vehicle_id']),
                    'contain' => $this->sContain,
                    'order'=> array($this->name.'.created DESC')
            );

            $ret =  parent::find('first', $cond);
            if (empty($ret)) {
                if (empty($this->Vehicle)){
                    $this->Vehicle = ClassRegistry::init('Vehicle');
                }
                $ret = $this->Vehicle->find('first', array(
                        'conditions'=> array('Vehicle.id'=>$fields['vehicle_id']),
                        'contain' => $this->sContain['Vehicle'],
                ));
                if (!empty($ret['Vehicle']['Customer'])) {
                    $ret['Customer'] = $ret['Vehicle']['Customer'];
                }
            }

            if (!empty($ret['Customer'])) {
                $ret['Vehicle']['Customer'] = $ret['Customer'];
                unset($ret['Customer']);
            }
        } else {
            $ret = parent::find($conditions, $fields, $order, $recursive);
        }
      

        // DOMICILIO
        $encontrado = false;
        if (!empty($ret['Vehicle']['Customer']['CustomerHome'])) {
            foreach ($ret['Vehicle']['Customer']['CustomerHome'] as $h) {
                if ($h['type']== 'Legal') {
                    foreach ($h as $k=>$v) {
                        $ret['Vehicle']['Customer']['Home'][$k] = $v;
                    }
                    $encontrado = true;
                    break;
                }
                if (!$encontrado) {
                    if ($h['type']== 'Comercial') {
                        foreach ($h as $k=>$v) {
                            $ret['Vehicle']['Customer']['Home'][$k] = $v;
                        }
                        $encontrado = true;
                        break;
                    }
                }
                if (!$encontrado) {
                    foreach ($h as $k=>$v) {
                        $ret['Vehicle']['Customer']['Home'][$k] = $v;
                    }
                }
            }
        }

        // IDENTIFICACION
         if (!empty($ret['Vehicle']['Customer']['Identification']['IdentificationType'])) {
            $ret['Vehicle']['Customer']['identification_type'] = $ret['Vehicle']['Customer']['Identification']['IdentificationType']['name'];
            $ret['Vehicle']['Customer']['identification_number'] = $ret['Vehicle']['Customer']['Identification']['number'];
         }

         // Actores Genericos
         if (!empty($ret['Vehicle']['Customer']['id'])) {
            $actoresGen = $this->Vehicle->Customer->Character->find('all', array(
                'contain'=> array('CharacterType'),
                'conditions'=> array(
                    'OR' => array(
                        'Character.customer_id'=>$ret['Vehicle']['Customer']['id'],
                        'Character.customer_id IS NULL',
                    )
                )
            ));
            foreach ($actoresGen as $aG) {
                $ret['Vehicle']['Customer']['Character'][] = $aG['Character'];
            }
             //debug($actoresGen);
         }

        $this->data = $ret;

        // AGregar nombre con CUIT si es Clicnte Juridico
        $nombreCuit = $this->getNombreWidthCuitIfLegal('Customer');
        $ret['Vehicle']['Customer']['name_n_cuit'] = $nombreCuit;

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

        // asigno los valoresque en field_coordenates ya tienen un campo en la tabla del model asignado
        $this->autoPopulateFields();

       
    }



    private function makePopulation($p){
         if (!empty($p['FieldCoordenate']['related_field_table'])) {
                $campo = $p['FieldCoordenate']['related_field_table'];
                $formCampoNombre = $p['FieldCoordenate']['name'];
                $fontSize = $p['FieldCoordenate']['font_size'];

                if (!array_key_exists($campo, $this->data[$this->name])) {
                        debug("no existe el campo $campo para el FieldCreator ID() ".$p['FieldCoordenate']['id']);
                        return -1; // el campo no existe como columna del modelo
                }

                if(!empty($p['FieldCoordenate']['continue_field_coordenate_id'])){
                    $arrayCampos = array(
                        'renglones'=> array(
                            $p['FieldCoordenate']['name'],
                            $p['FieldContinue']['name']),
                        'field_name'=>$this->data[$this->name][trim($campo)]);
                    $this->meterNombreCompletoEnVariosRenglones($arrayCampos);
                } else {
                    $valor = $this->data[$this->name][trim($campo)];
                    $this->populateFieldWithValue($formCampoNombre, $valor, array('fontSize'=>$fontSize));
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
    function autoPopulateFields(){
        $fallo = false;
        foreach ($this->fieldsPage1 as $p){
           if ($this->makePopulation($p) <0){
               $fallo = true;
           }
        }
        unset($p);
        foreach ($this->fieldsPage2 as $p){
           if ($this->makePopulation($p) <0){
               $fallo = true;
           }
        }

        if ($fallo && (Configure::read('debug') > 0)){
                die;
        }
    }


    /**
     *  aca puedo escribir codigo javascript para ser ejecutado al final de la
     *  vista del formulario ADD_FORM
     *
     * @return string
     *                  EJ:  echo 'var algo=null;';
     */
    function getJavascript(){
        echo '';
    }



    /**
     * Setter del atributo fields desde la tabla correspondiente al Model actual
     *
     * @return array de fields
     */
    private function loadFields() {
        $this->FieldCoordenate = ClassRegistry::init('FieldCoordenate');
        $id = $this->getFieldCreatorId();

        
        $this->fieldsPage1 = $this->FieldCoordenate->find('all', array(
                'conditions'=>array(
                        'FieldCoordenate.field_creator_id'=>(int)$id,
                        'FieldCoordenate.page'=>1,
                ),
                'contain'=>array('FieldType','FieldContinue')
        ));

        $this->fieldsPage2 = $this->FieldCoordenate->find('all', array(
                'conditions'=>array(
                        'FieldCoordenate.field_creator_id'=>(int)$id,
                        'FieldCoordenate.page'=>2,
                ),
                'contain'=>array('FieldType','FieldContinue')
        ));
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
    function getViewVars () {
        return array();
    }


    /**
     * Dado un campo por su nombre, me introduce el valor en el array fields
     *
     * @param string $fieldname es el campo "name" de la tabla field_coordenates. Es el campo al cual yo quiero ponerle un valor
     * @param string $value el valor que quiero que se muestre en el PDF
     * @param array $options
     *                      ['fontSize'] tamaño de la fuente por defaul en 10pt
     *
     * @return integer pagina donde fue encontrada (1 o 2) retorna 0 si no encuentra nada
     *
     */
    function populateFieldWithValue($fieldname, $value, $options = array('fontSize'=>10)) {
        if (empty($fieldname)) return -1;

        foreach ($this->fieldsPage1 as &$f) {
            if(($f['FieldCoordenate']['name'] == $fieldname)) {
                $f['FieldCoordenate']['value'] = $value;
                $f['FieldCoordenate']['fontSize'] = $options['fontSize'];
                return 1;
            }
        }
        foreach ($this->fieldsPage2 as &$f) {
            if(($f['FieldCoordenate']['name'] == $fieldname)) {
                $f['FieldCoordenate']['value'] = $value;
                $f['FieldCoordenate']['fontSize'] = $options['fontSize'];
                return 2;
            }
        }
        debug("<br>El campo '$fieldname' para el valor '$value' no fué encontrado<br>");
        $this->log("$this->name PopulateFieldWidthValue::: El campo '$fieldname' para el valor '$value' no fué encontrado.",'field_coordenates');
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
    function meterNombreCompletoEnVariosRenglonesConCuit($options, $model = 'Customer', $metercuit = true) {
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
    function getNombreWidthCuitIfLegal($model) {
        $d = $this->data;
        $tName = '';
        if ($model == 'Customer') {
            // NOMBRE   (Si es persona jurídica le tengo que poner el CUIT a lo ultimo del nombre)
            $tName = $d['Vehicle']['Customer']['name'];
            if (!empty($d['Vehicle']['Customer']['Identification']['IdentificationType'])) {
                $tipoYDoc = $d['Vehicle']['Customer']['Identification']['IdentificationType']['name']." ".$d['Vehicle']['Customer']['Identification']['number'];

                $tipoId = $d['Vehicle']['Customer']['Identification']['IdentificationType']['id'];
                $tipoYDoc = ($tipoId == 2 || $tipoId == 7 ) // SI ES CUIT o CUIL !!
                        ? $tipoYDoc : '';
                $tName .= " ".$tipoYDoc;
            }
        } else { // model DEL tipo 'Character'
            // NOMBRE   (Si es persona jurídica le tengo que poner el CUIT a lo ultimo del nombre)
            $tName = $d[$model]['name'];
            if (!empty($d[$model]['IdentificationType'])) {
                $tipoYDoc = $d[$model]['IdentificationType']['name']." ".$d[$model]['identification_number'];

                $tipoId = $d[$model]['IdentificationType']['id'];
                $tipoYDoc = ($tipoId == 2 || $tipoId == 7 ) // SI ES CUIT o CUIL !!
                        ? $tipoYDoc : '';
                $tName .= " ".$tipoYDoc;
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
    function  meterNombreCompletoEnVariosRenglones($options) {
        if(empty($options['field_name'])) {
            return -2;
        }
        
        if(empty($options['renglones'])) {
            $this->log("en metodo meterNomvreCOmpletoEnVariosCamposn no se pasaron los paramentros correctamente");
            debug("no se pasaron los parametros correctamente");
            debug($options);
            return -1;
        }

        // preparo el texto en array para recorrerlo y calcular su tamaño
        $vec = explode(" ",$options['field_name']);

        // inicializo el FPDF para luego verificar el tamaño de la celda
        App::import('Vendor','fpdf/fpdf');
        $orientation='P';
        $unit='mm';
        $format='legal';
        $fpdfAux = new FPDF();
        $fpdfAux->FPDF($orientation, $unit, $format);
        $fpdfAux->AddPage();
        // Fuente
        $fpdfAux->SetFont('Courier','',10);
        $field_coord = ClassRegistry::init('FieldCoordenate');
        foreach($options['renglones'] as $r) {
            $coordenada = $field_coord->find('first', array(
                    'conditions'=>array(
                            'FieldCoordenate.name'=>$r,
                            'FieldCoordenate.field_creator_id'=>$this->getFieldCreatorId(),
            )));
            $texto = '';

            // si oes multicell entonces meto todo el string de una saque eso lo maneja el propio metodo Multicell
            if ($coordenada['FieldCoordenate']['field_type_id'] == 3) { // Multicell
                $texto = implode(" ", $vec);
                $this->populateFieldWithValue($coordenada['FieldCoordenate']['name'], $texto);
                return 1;
            }

            while ($palabra = array_shift($vec)) {
                if (strtoupper($palabra) == 'CUIT' || strtoupper($palabra) == 'CUIL') {
                    $palabra .= " ".array_shift($vec);
                }
                // si el renglon tiene ancho infinito, o sin límite
                if ($coordenada['FieldCoordenate']['w'] == 0) {
                    array_unshift($vec,$palabra);
                    $texto = implode(" ", $vec);
                    $vec = array(); // vacio el array
                }
                if ($coordenada['FieldCoordenate']['w'] >= $fpdfAux->GetStringWidth(iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $texto." " . $palabra))) {
                    $texto .= " " . $palabra;
                } else {
                    array_unshift($vec,$palabra);
                    break;
                }
            }
            $this->populateFieldWithValue($coordenada['FieldCoordenate']['name'], $texto);
            $texto = ''; // lo vuelvo a inicializar
            if (count($vec)==0) break; // salgo del For renglones
        }
        return 2;
    }


    /**
     *
     * @param string $nationality argentino, extranjero o null es lo que puede venir
     * @param integer $id_type es el id de la tabla identification_types
     * @param array $fieldNames es un array con los nombres de los campos a imprimir
     *                          cargados en la tabla field_coordenates
     *                  las posibilidades son
     *      $fieldNames[argentino|extranjero][dni]
     *                                       [cuit]
     *                                       [le]
     *                                       [lc]
     *                                       [ci]
     *                                       [pasaporte]
     */
    function populateIdentifications($nationality, $id_type, $fieldNames) {
        switch($id_type) {
            case 1: // DNI
                $this->populateFieldWithValue($fieldNames[$nationality]['dni'], 'X');
                break;
            case 2: // CUIT
                $this->populateFieldWithValue($fieldNames[$nationality]['cuit'], 'X');
                break;
            case 3: // LE
                $this->populateFieldWithValue($fieldNames[$nationality]['le'], 'X');
                break;
            case 4: // LC
                $this->populateFieldWithValue($fieldNames[$nationality]['lc'], 'X');
                break;
            case 5: // CI
                $this->populateFieldWithValue($fieldNames[$nationality]['ci'], 'X');
                break;
            case 6: // Pasaporte
                $this->populateFieldWithValue($fieldNames[$nationality]['pasaporte'], 'X');
                break;
        }
    }


    /**
     *
     * @param integer $marital_status_id
     * @param array $fields
     *                      ['casado']
     *                      ['soltero']
     *                      ['viudo']
     *                      ['divorciado']
     */
    function populateMaritalStatuses($marital_status_id, $fields) {
        switch ($marital_status_id) {
            case 1: // Casado
                $this->populateFieldWithValue($fields['casado'], 'X');
                break;
            case 2: //Soltero
                $this->populateFieldWithValue($fields['soltero'], 'X');
                break;
            case 3: // Viudo
                $this->populateFieldWithValue($fields['viudo'], 'X');
                break;
            case 4 : // DIvorciado
                $this->populateFieldWithValue($fields['divorciado'], 'X');
                break;
        }
    }



    /**
     *
     * @param string $date date value de la base de datos, un DATETIME, o TIMESTAMP
     * @param array $fields
     *                       ['dia']
     *                       ['mes']
     *                       ['año']
     */
    function populateDayMonthYear($date, $fields = null) {
        if (empty($date)) {
            return -1;
        }
        if (empty($fields)) {
            $fields = array(
                    'dia'=> 'dia',
                    'mes'=> 'mes',
                    'año'=> 'año',
            );
        }
        $this->populateFieldWithValue($fields['dia'], date('d', strtotime($date)));
        $this->populateFieldWithValue($fields['mes'], date('m', strtotime($date)));
        $this->populateFieldWithValue($fields['año'], date('y', strtotime($date)));
    }








    
 

}

?>
