<?php

$ant = 0;
foreach ($res as $r) {
    if ($r['FieldCreator']['id'] != $ant) {
        echo "<hr>";
        echo "<h2>Form" . $r['FieldCreator']['name'] . " (ID: ".$r['FieldCreator']['id'].")</h2>";
    }
    $ant = $r['FieldCreator']['id'];
    echo '$this->populateFieldWithValue("'.$r['FieldCoordenate']['name'].'", $d["Model"]["fieldname"]);';
    echo '<br>';
}

?>
