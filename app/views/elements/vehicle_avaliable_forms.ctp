<div id="formulario-de-<?= $v['Vehicle']['id'] ?>" style="display: none;" class="box-list-forms">
    <h2>Seleccionar Formulario para</h2>
    <h3><?= $vehicleName ?></h3>
    <?
    $formus = ClassRegistry::init('FieldCreator');
    $ff = $formus->find('all', array('conditions' => array('activo' => true)));
    $i = 0;
    foreach ($ff as $f) {
        $action = (!empty($f['FieldCreator']['model'])) ?
                       '/field_creators/addForm/'. $f['FieldCreator']['model'] . '/' . $v['Vehicle']['id']
                       : '/field_form_fields/add/' . $f['FieldCreator']['id'] . '/' . $v['Vehicle']['id'];
        echo $this->Html->link($f['FieldCreator']['name'], $action);
        $i++;
        echo ($i % 4 == 0) ? '<br>' : '';
    }
    ?>
</div>