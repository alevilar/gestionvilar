
<?php

$formId = $res['FieldCreator']['id'];
$formModel = $res['FieldCreator']['model'];

$elementosCustomer= array();
foreach ($actoresInvolucrados as $a){
    if (empty($a)) continue;
    $ac = ucwords(strtolower($a));
    $elementosCustomer[] = "$a => $ac";
}


$elementosActores = array();
foreach ($actoresInvolucrados as $a){
    $ac = ucwords(strtolower($a));
    if (empty($a)) continue;
    $elementosActores[] = "array('field_forms/character_data'=> array('field_prefix'=>$a, 'label'=>\"Actor Como $ac\"))";
}




echo "<hr>";
echo "<h2>Form" . $res['FieldCreator']['name'] . " (ID: ".$res['FieldCreator']['id'].")</h2>";
?>

<pre>
<?php
echo "
App::import('Lib', 'FormSkeleton');


class $formModel extends FormSkeleton {

    var \$form_id = $formId;

    var \$involucrados = array(";

echo implode(',
                              ',$actoresInvolucrados);


echo ");

    var \$elements = array(
         array('field_forms/customer_to_character'=> array(
                            'label'=>'El Cliente es',
                            'options'=>array(";

echo implode(',
                                             ',$elementosCustomer);

echo ")
               )
         ),
         ";

echo implode(',
         ',$elementosActores);

echo "
         );



    function getFormImputs(\$data) {
        \$identificationsTypes = ClassRegistry::init('IdentificationType')->find('list');
        \$nationalities = \$this->Vehicle->Customer->CustomerNatural->nationalityTypes;
        \$maritalStatus = ClassRegistry::init('MaritalStatus')->find('list');

        \$coso =  array(

            // EJEMPLOS  ---------------------------
            array(
                'legend'=>'TITULO EJEMPLO',
                'se_certifica_obs' => array('type'=>'textarea', 'label'=>'Se certifica que las condiciones de indetificación que figuran en esta solicitud fueron verificacas con el certificado de fabricación y con el automotor cuya inscripción se solicita a favor del señor'),
                'obervaciones' => array('label'=>'Observaciones', 'type'=>'textarea'),
                 ),
            \$this->__representativePreform('comprador', 'Apoderado del Titular'),
            \$this->__representativePreform('condominiocomprador', 'Apoderado del Condominio'),

            \$this->__vehiclePreform1('Vehículo que se tansfiere'),

            //--------------------------- FIN EJEMPLOS 
            

            array(
                'legend' => 'TITULO LEYENDA',
";

$ant = 0;
$prefixAnt  = '';
foreach ($res['FieldCoordenate'] as $r) {
    
    if ( !empty($r['related_field_table']) ) {
        if (!empty($r['related_field_table_select']) && $r['related_field_table_select'] != '' && !empty($r['character_type'])){
            echo "
                         '".low($r['related_field_table'])."' => array('label' => '".$r['name']."', 'value' => \$this->getDatafromField('".  Inflector::camelize($r['character_type'])."','".$r['related_field_table_select']."')),";
        } else {
            echo "
                         '".low($r['related_field_table'])."' => array('label' => '".$r['name']."'),";
        }
    } else {
        echo "
                         '".Inflector::slug(low($r['name']))."' => array('label' => '".$r['name']."'),";
    }
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