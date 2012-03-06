<?php
$nombreDelForm = '';

echo "<ul>";
foreach($res as $r){
    $ids = array();
    
    if ( $nombreDelForm != $r['f']['name']) {
        echo "</ul>";
        $nombreDelForm = $r['f']['name'];
        echo "<h2>$nombreDelForm</h2>";
        echo "<ul>";
    }
    $fieldTable = $r['a']['related_field_table'];
    $nombre = $r['a']['name'];
    $miid = $r['a']['id'];
    $suid = $r['b']['id'];
    if (!in_array($miid, $ids) && !in_array($suid, $ids)) {
        $ids[] = $miid;
        $ids[] = $suid;
        echo "<li>related_field_table: $fieldTable -:::- <b>El parecido id: $suid</b><span> Mi Id: $miid</span> Nombre: <b>$nombre</b></li>";
    }

}