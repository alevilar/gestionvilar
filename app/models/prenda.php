<?php

App::import('Lib', 'FormSkeleton');


class Prenda extends FormSkeleton {

    var $form_id = 22;

    var $involucrados = array('deudor',
                              'acreedor');

    var $elements = array(
         array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array('deudor' => 'deudor',
                                             'acreedor' => 'acreedor')
               )
         ),
         array('field_forms/character_data'=> array('field_prefix'=>'deudor', 'label'=>"Actor Como 'deudor'")),
         array('field_forms/character_data'=> array('field_prefix'=>'acreedor', 'label'=>"Actor Como 'acreedor'")),
         );


    function beforeSave($options)
    {
        parent::beforeSave($options);
        
         $MS = ClassRegistry::init('MaritalStatus');
        if (!empty($this->data[$this->name]['acreedor_marital_status_id'])) {
            $MS->id = $this->data[$this->name]['acreedor_marital_status_id'];
            $maritalName = strtoupper( $MS->field('name') );
            $this->data[$this->name]['acreedor_marital_status'] = $maritalName;
        }
        
        if (!empty($this->data[$this->name]['deudor_marital_status_id'])) {
            $MS->id = $this->data[$this->name]['deudor_marital_status_id'];
            $maritalName = strtoupper( $MS->field('name') );
            $this->data[$this->name]['deudor_marital_status'] = $maritalName;
        }

        return true;
        
    }

    function getFormImputs($data) {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso =  array(
            array(
                'legend' => 'Introducción',
                
                         'clase_fija_flotante' => array('label' => 'Clase (¿fija o flotante?)', 'value' => 'FIJA'),
                
                'precio' => array('label' => 'Por $'),
                'precio_texto' => array('label' => 'La suma de'),
                
                         'deudor_name' => array('label' => 'que el señor', 'value' => $this->getDatafromField('Deudor','name')),
                         'deudor_concepto' => array('label' => 'declara adeudar en concepto de:'),
                         'acreedor_name' => array('label' => 'a don', 'value' => $this->getDatafromField('Acreedor','name')),
                ),
            array(
                'legend' => 'Ubicación de los bienes',
                         'deudor_bienes' => array('label' => 'Bienes'),
                         'deudor_home_state' => array('label' => 'Provincia', 'value' => $this->getDatafromField('Deudor','home_state')),
                         'deudor_home_county' => array('label' => 'Depto o Partido', 'value' => $this->getDatafromField('Deudor','home_county')),
                         'deudor_distrito' => array('label' => 'Distrito o Pedanía'),
                         'deudor_campo' => array('label' => 'Nombre o N° del campo o establecimiento'),
                         'deudor_home_address' => array('label' => 'Calle', 'value' => $this->getDatafromField('Deudor','home_address')),
                         'deudor_home_number' => array('label' => 'N°', 'value' => $this->getDatafromField('Deudor','home_number')),
                         'deudor_home_city' => array('label' => 'Ciudad o Pueblo', 'value' => $this->getDatafromField('Deudor','home_city')),
                ),
            array(
                'legend' => 'Gravámenes/Documentación/Intereses/Pago',
                         'deudor_gravamenes' => array('label' => 'Gravámenes', 'value' => 'NINGUNO DE NINGUNA NATURALEZA'),
                         'deudor_documentacion' => array('label' => 'Documentación'),
                         'deudor_vencimientos' => array('label' => 'Vencimientos'),
                
                         'acreedor_intereses' => array('label' => 'Intereses'),
                         'lugar_de_pago' => array('label' => 'Lugar de pago'),
                         'derechos_de_inspeccion' => array('label' => 'Derechos de Inspección del acreedor', 'value' => 'AMPLIOS'),
                ),
            array(
                'legend' => 'Seguro',
                         'seguro_valor' => array('label' => '... por la suma de:', 'value' => 'EN TRÁMITE ---------------------------'),
                         'seguro_contra' => array('label' => ', contra'),
                         'seguro_compania' => array('label' => 'en la compañia'),
                         'seguro_domiciliada' => array('label' => 'domiciliada en la calle'),
                         'seguro_numero_postal' => array('label' => 'numero postal'),
                         'seguro_poliza_numero' => array('label' => 'Poliza N°'),
                         'seguro_vencimiento_dia' => array('label' => 'vencimiento dia'),
                         'seguro_vencimiento_anio' => array('label' => 'vencimiento año'),
                         'seguro_en_poder_del' => array('label' => 'en poder del'),
                ),
            array(
                'legend' => 'Acreedor',
                         'acreedor_inscripcion' => array('label' => 'Inscripción', 'value' => $this->getDatafromField('Acreedor','inscripcion')),
                         'acreedor_name' => array('label' => 'Nombre y Apellido', 'value' => $this->getDatafromField('Acreedor','name')),
                         'acreedor_marital_status_id' => array('label' => 'Estado Civil', 'value' => $this->getDatafromField('Acreedor','marital_status_id'), 'options' => $maritalStatus, 'empty'=>'Seleccione'),
                         'acreedor_habitualidad' => array('label' => 'Habitualidad'),
                         'acreedor_nationality' => array('label' => 'Nacionalidad', 'value' => $this->getDatafromField('Acreedor','nationality')),
                         'acreedor_edad' => array('label' => 'Edad'),
                         'acreedor_home_address' => array('label' => 'Domicilio', 'value' => $this->getDatafromField('Acreedor','home_address')),
                         'acreedor_identification_number' => array('label' => 'DNI', 'value' => $this->getDatafromField('Acreedor','identification_number')),
                         'acreedor_inscription_number' => array('label' => 'N° de Inscripción', 'value' => $this->getDatafromField('Acreedor','inscription_number')),
            ),
            array(
                'legend' => 'Deudor',
                        'deudor_marital_status_id' => array(
                            'label' => 'Estado Civil', 
                            'value' => $this->getDatafromField('Deudor','marital_status_id'), 
                            'options' => $maritalStatus, 
                            'empty'=>'Seleccione'),
                        'deudor_name' => array('label' => 'Nombre y Apellido', 'value' => $this->getDatafromField('Deudor','name')),
                        'deudor_ocupation' => array('label' => 'Profesión', 'value' => $this->getDatafromField('Deudor','ocupation')),
                        'deudor_nationality' => array('label' => 'Nacionalidad', 'value' => $this->getDatafromField('Deudor','nationality')),                
                        'deudor_edad' => array('label' => 'Edad'),
                        'deudor_home_address' => array('label' => 'Domicilio', 'value' => $this->getDatafromField('Deudor','home_address')),
                        'deudor_identification_number' => array('label' => 'DNI', 'value' => $this->getDatafromField('Deudor','identification_number')),                
                        'deudor_inscription_number' => array('label' => 'N° de Inscripción', 'value' => $this->getDatafromField('Deudor','inscription_number')),
                ),
            array(
                'legend' => 'Traslado',
                         'traslado' => array('label' => 'traslado'),
                         'traslado_de' => array('label' => 'traslado de'),
                         'traslado_de_2' => array('label' => 'traslado de 2'),
                         'ubicacion' => array('label' => 'ubicacion'),
                         'nota_archivada_n' => array('label' => 'nota archivada n°'),
                         'otras_anotaciones' => array('label' => 'otras anotaciones'),
                         'certifica_firma_acreedor' => array('label' => 'certifica firma acreedor'),
                         'certifica_firma_acreedor' => array('label' => 'certificamos firma acreedor'),
                         'certifica_firma_deudor' => array('label' => 'certificamos firma deudor'),
           )

        );


        return $coso;
    }
}