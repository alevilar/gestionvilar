<?php


App::import('Lib', 'FormSkeleton');


class F13acaba extends FormSkeleton {

    var $form_id = 10;

    var $involucrados = array('titular');

    var $elements = array(
         array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array('titular' => 'titular')
               )
         ),
         array('field_forms/character_data'=> array('field_prefix'=>'titular', 'label'=>"Actor Como 'titular'"))
         );



    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(

            array(
                'legend' => 'Titular',
                         //'titular_identification_number' => array('label' => 'Numero de Documento del Titular', 'value' => $this->getDataFromField('Titular','identification_number')),
                         'titular_identification_type_id' => array('label' => 'Numero', 'options' => $identificationsTypes, 'empty' => 'Seleccione'),
                         'titular_cuit_cuil' => array('label' => 'Numero (para Empresas Nro de C.U.I.T o D.N.R.', 'value' => $this->getTipoYNumero()),
                         'datos_del_titular' => array('label' => 'Datos del Titular'),
                         'titular_name' => array('label' => 'Apellido y Nombres o Denominacion', 'value' => $this->getDataFromField('Titular','name')),
                         'titular_localidad' => array('label' => 'Domicilio fiscal - Leyenda Calle - Localidad', 'value' => $this->getDataFromField('Titular','localidad')),
                         'titular_numero_calle' => array('label' => 'Nro Puerta', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => 'Piso', 'value' => $this->getDataFromField('Titular','piso')),
                         'titular_depto' => array('label' => 'Dpto', 'value' => $this->getDataFromField('Titular','depto')),
                         'titular_cp' => array('label' => 'Cod Postal', 'value' => $this->getDataFromField('Titular','cp')),
                         'titular_calle' => array('label' => 'Domicilio Postal - Leyenda Calle - Localidad', 'value' => $this->getDataFromField('Titular','calle')),
                         'titular_numero_calle' => array('label' => '2 Nro Puerta', 'value' => $this->getDataFromField('Titular','numero_calle')),
                         'titular_piso' => array('label' => '2 Piso', 'value' => $this->getDataFromField('Titular','piso')),
                         'titular_depto' => array('label' => '2 Dpto', 'value' => $this->getDataFromField('Titular','depto')),
                         'titular_cp' => array('label' => '2 Cod Postal', 'value' => $this->getDataFromField('Titular','cp')),
           ),
            array(
                'legend' => 'Vehículo',
                        'datos_del_automotor' => array('label' => 'Datos del Automotor'),
                         'fecha_vencimiento' => array('label' => 'Fecha Vencimiento'),
                         'ca_m' => array('label' => 'CA/m'),
                         'fecha_alta' => array('label' => 'Fecha - Alta'),
                         'planilla_nro' => array('label' => 'Planilla - Nro'),
                         'let' => array('label' => 'Let'),
                         'numero' => array('label' => 'Numero'),
                         'd_v' => array('label' => 'D.V'),
                         's_f' => array('label' => 'S/F'),
                         'rubro' => array('label' => 'Rubro'),
                         'categ' => array('label' => 'Categ/'),
                         'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDataFromField('Vehicle','brand')),
                         'codigo_de_marca' => array('label' => 'Codigo de Marca'),
                         'vehicle_model' => array('label' => 'Modelo', 'value' => $this->getDataFromField('Vehicle','model')),
                         'or' => array('label' => 'Or'),
                         'cu' => array('label' => 'Cu'),
                         'peso_cilin' => array('label' => 'Peso/Cilin'),
                         'vehicle_motor_number' => array('label' => 'Numero de Motor', 'value' => $this->getDataFromField('Vehicle','motor_number')),
                         'constancia_de_documentos_exhibidos' => array('label' => 'Constancia de Documentos Exhibidos'),
                         'titulo_de_propiedad_fotocopia' => array('label' => 'Titulo de Propiedad Fotocopia'),
                         'factura_de_compra_fotocopia' => array('label' => 'Factura de Compra Fotocopia'),
                         'constancia_de_pago_del_gravamen_ingresos_brut' => array('label' => 'Constancia de Pago del Gravamen Ingresos Brut'),
                         'certificado_de_aduana_vehiculos_importados' => array('label' => 'Certificado de Aduana (Vehiculos Importados) '),
                         'observaciones' => array('label' => 'Observaciones'),
            ),
        );


        return $coso;
    }
}
