<?php

App::import('Lib', 'FormSkeleton');

class F13ba extends FormSkeleton
{

    var $form_id = 9;
    var $involucrados = array('titular',
        'condominio');
    var $elements = array(
        array('field_forms/customer_to_character' => array(
                'label' => 'El Cliente es',
                'options' => array('titular' => 'titular',
                    'condominio' => 'condominio')
            )
        ),
        array('field_forms/character_data' => array('field_prefix' => 'titular', 'label' => "Actor Como 'titular'")),
        array('field_forms/character_data' => array('field_prefix' => 'condominio', 'label' => "Actor Como 'condominio'"))
    );

    function getFormImputs($data)
    {
        $identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        $nationalities = $this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        $maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        $coso = array(
            array(
                'legend' => 'Titular',
                'titular_name' => array('label' => 'Titular Apellido y Nombre o Razón Social'),
                'titular_cuit_cuil' => array('label' => 'titular Doc. Identidad - N° Personas Jurídica'),
                'titular_cp' => array('label' => 'titular Código Postal'),
                'titular_localidad' => array('label' => 'titular Localidad'),
//                 '' => array('label' => 'letra'),
//                 '' => array('label' => 'numero'),

                'titular_cuit_cuil' => array('label' => 'Doc. Identidad - N° Personas Jurídicas - tipo'),
                'titular_calle' => array('label' => 'titular calle'),
                'titular_numero_calle' => array('label' => 'titular numero'),
                'titular_piso' => array('label' => 'titular piso'),
//                 '_depto' => array('label' => 'titular dpto'),
//                 '_cp' => array('label' => 'titular postal codigo postal'),
                'titular_localidad' => array('label' => 'titular postal localidad'),
//                 '' => array('label' => 'titular  postal calle'),
//                 '' => array('label' => 'titular postal numero'),
//                 '' => array('label' => 'titular postal piso'),
//                 '' => array('label' => 'titular postal dpto'),
            ),
            array(
                'legend' => 'Condominio',
                'condominio_name' => array('label' => 'condominio apellido y nombre o razon social'),
                'condominio_cuit_cuil' => array('label' => 'condominio doc iden n° personas juridicas num'),
//                 '' => array('label' => 'condominio doc iden n° personas juridicas tip'),
                'condominio_cp' => array('label' => 'condominio codigo postal'),
                'condominio_localidad' => array('label' => 'condominio localidad'),
                'condominio_calle' => array('label' => 'condominio calle'),
                'condominio_numero_calle' => array('label' => 'condominio numero'),
                'condominio_piso' => array('label' => 'condominio piso'),
                'condominio_depto' => array('label' => 'condominio depto'),
                'condominio_name' => array('label' => 'condominio 1 apellido y nombre o razon social'),
                'condominio_cuit_cuil' => array('label' => 'condominio 1 doc iden n°persona juridicas num'),
//                 '' => array('label' => 'condominio 1 doc iden n°persona juridicas tip'),
//                 '' => array('label' => 'condominio 1 codigo postal'),
//                 '' => array('label' => 'condominio 1 localidad'),
//                 '' => array('label' => 'condominio 1 calle'),
//                 '' => array('label' => 'condominio 1 numero'),
//                 '' => array('label' => 'condominio 1 piso'),
//                 '' => array('label' => 'condominio 1 dpto'),
            ),

            $this->__vehiclePreform1('Vehículo que se tansfiere'),
//            array(
//                'legend' => 'Vehículo',
//                'vehicle_patente' => array('label' => 'Dominio'),
//                'vehicle_brand' => array('label' => 'Marca'),
//                'vehicle_model' => array('label' => 'Modelo año'),
//                'vehicle_type' => array('label' => 'titular Tipo'),
//                'vehicle_motor_number' => array('label' => 'Número de Motor'),
//                'vehicle_brand' => array('label' => 'marca automotor'),
//                'vehicle_number' => array('label' => 'numero motor'),
//            ),
        );


        return $coso;
    }

}
