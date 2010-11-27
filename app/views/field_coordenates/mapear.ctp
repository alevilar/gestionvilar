
<?php
echo "<hr>";
echo "<h2>Form" . $res['FieldCreator']['name'] . " (ID: ".$res['FieldCreator']['id'].")</h2>";
?>

<pre>
<?php
echo "
App::import('Lib', 'FormSkeleton');


class F13ba extends FormSkeleton {

    //var \$belongsTo = array('Vehicle','Character','Spouse', 'Representative');

    var \$form_id = 9;

    var \$involucrados = array('titular', 'condominio');

    var \$elements = array(
          array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array(
                                'comprador'=>'Titular',
                                'condominiocomprador'=>'Condominio',
                                ))),
          array('field_forms/character_data'=> array('field_prefix'=>'comprador', 'label'=>'Actor Como \"Titular\"')),
          array('field_forms/character_data'=> array('field_prefix'=>'condominiocomprador', 'label'=>'Actor Como \"Condominio\"')),
    );



    function getFormImputs(\$data) {
        \$identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        \$nationalities = \$this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        \$maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        \$coso =  array(

            // EJEMPLOS
            array(
                'legend'=>'TITULO EJEMPLO',
                'se_certifica_obs' => array('type'=>'textarea', 'label'=>'Se certifica que las condiciones de indetificación que figuran en esta solicitud fueron verificacas con el certificado de fabricación y con el automotor cuya inscripción se solicita a favor del señor'),
                'obervaciones' => array('label'=>'Observaciones', 'type'=>'textarea'),
                 ),
            \$this->__representativePreform('comprador', 'Apoderado del Titular'),
            \$this->__representativePreform('condominiocomprador', 'Apoderado del Condominio'),

            array(
                'legend' => 'TITULO LEYENDA',
";

$ant = 0;
foreach ($res['FieldCoordenate'] as $r) {
echo "
                 '".$r['related_field_table']."' => array('label' => '".$r['name']."'),";
}


echo "
           )
        );


        return \$coso;
    }
}
";

?>
</pre>