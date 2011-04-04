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
                 'legend' => 'Documento Titular',
                 //'titular_identification_number' => array('label' => 'Numero de Documento del Titular', 'value' => $this->getDatafromField('Titular','identification_number')),
                 'titular_identification_number' => array('label' => 'Numero', 'value' => $this->getDatafromField('Titular','identification_number')),
                 'titular_identification_type_id' => array('label' => 'Tipo Documento', 'options' => $identificationsTypes, 'empty' => 'Seleccione'),
                 'titular_cuit_cuil' => array('label' => 'Numero (para Empresas Nro de C.U.I.T o D.N.R.', 'value' => $this->getDatafromField('Titular','cuit_cuil')),
                ),
            array(
                'legend' => 'Datos del Titular',
                'titular_name' => array('label' => 'Apellido y Nombres o Denominacion', 'value' => $this->getDatafromField('Titular','name')),
                 'titular_localidad' => array('label' => 'Domicilio fiscal - Calle + Localidad', 'value' => $this->getDatafromField('Titular','localidad')),
                 'titular_numero_calle' => array('label' => 'Domicilio fiscal - Nro Puerta', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_piso' => array('label' => 'Domicilio fiscal - Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_depto' => array('label' => 'Domicilio fiscal - Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 'titular_cp' => array('label' => 'Domicilio fiscal - Cod Postal', 'value' => $this->getDatafromField('Titular','cp')),
                 'titular_dompostal_calle' => array('label' => 'Domicilio Postal - Calle - Localidad', 'value' => $this->getDatafromField('Titular','calle')),
                 'titular_dompostal_numero_calle' => array('label' => 'Domicilio Postal - Nro Puerta', 'value' => $this->getDatafromField('Titular','numero_calle')),
                 'titular_dompostal_piso' => array('label' => 'Domicilio Postal - Piso', 'value' => $this->getDatafromField('Titular','piso')),
                 'titular_dompostal_depto' => array('label' => 'Domicilio Postal - Dpto', 'value' => $this->getDatafromField('Titular','depto')),
                 'titular_dompostal_cp' => array('label' => 'Domicilio Postal - Cod Postal', 'value' => $this->getDatafromField('Titular','cp')),
            ),
            array(
                'legend' => 'Datos del Automotor',
                'vehicle_porcentaje' => array('label' => '%', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_vencimiento' => array('label' => 'Fecha Vencimiento', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_ca' => array('label' => 'CA/m', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_fechalta' => array('label' => 'Fecha - Alta', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_planillanro' => array('label' => 'Planilla - Nro', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_let' => array('label' => 'Let', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_numero' => array('label' => 'Numero', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_dv' => array('label' => 'D.V', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_sf' => array('label' => 'S/F', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_rubro' => array('label' => 'Rubro', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_categ' => array('label' => 'Categ/', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_brand' => array('label' => 'Marca', 'value' => $this->getDatafromField('Vehicle','brand')),
                 'vehicle_brandcode' => array('label' => 'Codigo de Marca', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_model' => array('label' => 'Modelo', 'value' => $this->getDatafromField('Vehicle','model')),
                 'vehicle_or' => array('label' => 'Or', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_cu' => array('label' => 'Cu', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_peso' => array('label' => 'Peso/Cilin', 'value' => $this->getDatafromField('Vehicle','')),
                 'vehicle_motor_number' => array('label' => 'Numero de Motor', 'value' => $this->getDatafromField('Vehicle','motor_number')),
            ),
            array(
                'legend' => '+',
                 'constancia_de_documentos_exhibidos' => array('label' => 'Constancia de Documentos Exhibidos'),
                 'constancia_titulopropiedad' => array('label' => 'Titulo de Propiedad Fotocopia'),
                 'constancia_facturacompra' => array('label' => 'Factura de Compra Fotocopia'),
                 'constancia_pagogravamen' => array('label' => 'Constancia de Pago del Gravamen Ingresos Brut'),
                 'constancia_aduana' => array('label' => 'Certificado de Aduana (Vehiculos Importados) '),
                 'observaciones' => array('label' => 'Observaciones'),
            ),
        );


        return $coso;
    }
}
?>
