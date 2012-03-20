<?php
$random = rand(1, 989898);

if (empty($formName)) {
    $formName = 'NoName';
}

if (empty ($label)) {
    $label = __('Customer is',true);
}

if (empty($options)) {
    debug("Este elemento necesita que le sean pasadas las opciones, variable \$options");
}

if (empty ($field)) {
    $field = 'customer_id';
}

// armo el JSON del cliente
if (empty($customer)) {
    $d = $this->data;
    //$customer = $this->data['Vehicle']['Customer'];
    if (!empty($d['Customer'])) {
        $d['Vehicle']['Customer'] = $d['Customer'];
    }

    if ( !empty($d['Vehicle']['Customer']) ) {
    foreach ($d['Vehicle']['Customer'] as $field=>$fval) {
            $customer[$field] = $fval;
        }
    }

    $customer['porcentaje'] = '100  00';
    $customer['name'] = $d['Vehicle']['Customer']['name'];
    $customer['cuit_cuil'] = $d['Vehicle']['Customer']["cuit_cuil"] ;

    // domicilio
    if (!empty($d['Vehicle']['Customer']['CustomerHome'])) {

        // si existe COmercial, sobreescribir las otras
        foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {

            if ($h['type']== 'Comercial') {
                $customer['calle'] = $h["address"] ;
                $customer['numero_calle'] =  $h["number"] ;
                $customer['piso'] = $h["floor"];
                $customer['depto'] = $h["apartment"];
                $customer['cp'] = $h["postal_code"];
                $customer['localidad'] = $h["city"];
                $customer['departamento'] = $h["county"] ;
                $customer['provincia'] = $h["state"];

                foreach ($h as $k=>$v) {
                    $customer['home_'.$k] = $v;
                }
            }
        }

        // si existe legal, sobreescribir las otras
        foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {
            
            if ($h['type']== 'Legal') {
                $customer['calle'] = $h["address"] ;
                $customer['numero_calle'] =  $h["number"] ;
                $customer['piso'] = $h["floor"];
                $customer['depto'] = $h["apartment"];
                $customer['cp'] = $h["postal_code"];
                $customer['localidad'] = $h["city"];
                $customer['departamento'] = $h["county"] ;
                $customer['provincia'] = $h["state"];

                foreach ($h as $k=>$v) {
                    $customer['home_'.$k] = $v;
                }
            }
        }

        // si existe guarda habitual, sobreescribir la otra
        foreach ($d['Vehicle']['Customer']['CustomerHome'] as $h) {
            if ($h['type']== 'Guarda Habitual') {
                $customer['calle'] = $h["address"] ;
                $customer['numero_calle'] =  $h["number"] ;
                $customer['piso'] = $h["floor"];
                $customer['depto'] = $h["apartment"];
                $customer['cp'] = $h["postal_code"];
                $customer['localidad'] = $h["city"];
                $customer['departamento'] = $h["county"] ;
                $customer['provincia'] = $h["state"];

                foreach ($h as $k=>$v) {
                    $customer['home_'.$k] = $v;
                }
            }
        }

        


        foreach ($d['Vehicle']['Customer']['CustomerHome'] as $home) {
            foreach ($home as $h=>$val){
                $prefix = 'home_'.strtolower($home['type']).'_';
                $customer[$prefix.$h] = $val;
            }
       }
    }


        
        

    // PERSONA FÍSICA
    if (!empty($d['Vehicle']['Customer']['CustomerNatural'])) {
        $customer['persona_fisica_o_juridica'] = 'fisica';
         $customer['ocupation'] = $d['Vehicle']['Customer']['CustomerNatural']['ocupation'] ;
        $customer['nationality_type_id'] =  $d['Vehicle']['Customer']['CustomerNatural']['nationality_type'] ;

        if (!empty($d['Vehicle']['Customer']['CustomerNatural']['born'])) {
            $customer['anio_nacimiento'] = date('y',strtotime($d['Vehicle']['Customer']['CustomerNatural']['born'])) ;
            $customer['mes_nacimiento']  = date('m',strtotime($d['Vehicle']['Customer']['CustomerNatural']['born']));
            $customer['dia_nacimiento']  = date('d',strtotime($d['Vehicle']['Customer']['CustomerNatural']['born'])) ;
            $customer['fecha_nacimiento'] = date('d-m-y',strtotime($d['Vehicle']['Customer']['CustomerNatural']['born']));
        }
        
        $customer['marital_status_id']  =  $d['Vehicle']["Customer"]['CustomerNatural']['marital_status_id'];
        $customer['nupcia'] = $d['Vehicle']["Customer"]['CustomerNatural']['nuptials'] ;
    } else {
    // PERSONA JURIDICA
        $customer['persona_fisica_o_juridica'] = 'juridica';
        if (!empty($d['Vehicle']["Customer"]['CustomerLegal'])) {
            $customer['personeria_otorgada'] = $d['Vehicle']["Customer"]['CustomerLegal']['inscription_entity'];
            $customer['inscripcion'] = $d['Vehicle']["Customer"]['CustomerLegal']['inscription_number'];

            if (!empty($d['Vehicle']['Customer']['CustomerLegal']['inscription_date'])) {
                $customer['anio_inscripcion'] = date('y',strtotime($d['Vehicle']['Customer']['CustomerLegal']['inscription_date'])) ;
                $customer['mes_inscripcion']  = date('m',strtotime($d['Vehicle']['Customer']['CustomerLegal']['inscription_date'])) ;
                $customer['dia_inscripcion']  = date('d',strtotime($d['Vehicle']['Customer']['CustomerLegal']['inscription_date'])) ;
                $customer['fecha_inscripcion'] = date('d-m-y',strtotime($d['Vehicle']['Customer']['CustomerLegal']['inscription_date']));
            }
        }
    }

    // IDENTIFICACION
    if (!empty($d['Vehicle']['Customer']['Identification'])) {
        $customer['identification_type_id'] = $d['Vehicle']['Customer']['Identification']['identification_type_id'] ;
        $customer['identification_number'] =  $d['Vehicle']['Customer']['Identification']['number'] ;
        $customer['identification_authority'] = $d['Vehicle']['Customer']['Identification']['authority_name'] ;
    }

    // CONYUGE
    if (!empty($d['Vehicle']['Customer']['CustomerNatural']['Spouse'])) {
        $spouse = $d['Vehicle']['Customer']['CustomerNatural']['Spouse'];
        $customer['conyuge'] = $spouse[0]['name'];
        $customer['conyuge_apoderado_name'] = $spouse[0]['name'];
        $customer['conyuge_apoderado_identification_type_id'] = $spouse[0]['identification_type_id'];
        $customer['conyuge_apoderado_identification_number'] = $spouse[0]['identification_number'];
        if (empty($spouse['identification_autority'])){
            $customer['conyuge_apoderado_nationality_type'] = 'argentino';
        } else {
            $customer['conyuge_apoderado_nationality_type'] = 'extranjero';
        }        
        $customer['conyuge_apoderado_identification_auth'] = $spouse[0]['identification_autority'];
    }

    // APODERADO
    if (!empty($d['Vehicle']['Customer']['Representative'])) {
        $customer['apoderado_name'] = $d['Vehicle']['Customer']['Representative'][0]['surname'].' '.$d['Vehicle']['Customer']['Representative'][0]['first_name'];
        foreach ( $d['Vehicle']['Customer']['Representative'] as $r) {
            foreach ($r as $key => $val) {
                $customer["apoderado_".$key] = $val;
            }
        }
    }


//    $customer['fecha_nacimiento'] = date('d-m-Y',strtotime($customer['fecha_nacimiento']));
//    $customer['fecha_inscripcion'] = date('d-m-Y',strtotime($customer['fecha_inscripcion']));

    $customer = json_encode($customer);
 
}
?>

<div id="element-customer-<?php echo $random?>" class="span-5 element">
    <?php if (!empty($label)) {?>
    <label><?php echo $label?></label>
        <?php }?>
    <select name="<?php echo "data[$formName][$field]"?>" id="<?php echo "FormCustomerId-$random" ?>">
        <option value="">Seleccione</option>
        <?php foreach ($options as $o=>$v) {?>
        <option class="opt-customer" value="<?php echo $o?>" json='<?php echo $customer?>'><?php echo $v?></option>
            <?php }?>
    </select>
</div>



<script type="text/javascript">
    lastElementValue = 'comprador';
    // funcion que sirve para limpiar el codigo de los eventos de este script
    function meterCustomer(){
        var modelName = '<?php echo 'Customer' ?>';
        var formName = '<?php echo $formName?>';
        var elementValue = $('<?php echo "#FormCustomerId-$random" ?>').val();
        var randomNumber = <?php echo $random?>;
        
        if (modelName && formName && randomNumber) {
            if (elementValue) {
                lastElementValue = elementValue;
            }
           populateCampos(modelName,formName, lastElementValue, randomNumber);
        }
    }

    // Evento cuando se carga lapagina
    $(document).ready(function(){
        meterCustomer();

    });

    // Evento cuando se cambia la opcion del SELECT
    $('<?php echo "#FormCustomerId-$random" ?>').change(meterCustomer);

    $('<?php echo "#FormCustomerId-$random" ?>').click(meterCustomer);

</script>
