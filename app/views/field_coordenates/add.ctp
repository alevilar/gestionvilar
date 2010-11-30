<div class="fieldCoordenates form">
    <?php echo $this->Form->create('FieldCoordenate');?>
    <fieldset>
        <legend><?php printf(__('Add %s', true), __('Field Coordenate', true)); ?></legend>
        <?php
        echo $this->Form->input('field_creator_id');
        echo $this->Form->input('name');
        echo $this->Form->input('field_type_id');
        echo $this->Form->input('font_size', array('default'=>10, 'after'=>'también se peden ingresar valores con decimales. Ej: 12.45 (notar que el decimal va con punto)'));
        echo $this->Form->input('x', array('after'=>'Coordenada X en milimetros'));
        echo $this->Form->input('y', array('after'=>'Coordenada Y en milimetros'));
        echo $this->Form->input('page', array('default'=>1,'label'=>'¿El campo se imprime en la página 1 o de la 2?', 'options'=>array(1=>1,2=>2)));
        echo $this->Form->input('w', array('default'=>0, 'after'=>'Ancho en milimetros. Si queda en cero, el ancho no importa'));
        echo $this->Form->input('h', array('default'=>0, 'after'=>'Elalto de la celda en milimetros. Si queda en cero, el alto no importa'));
        echo $this->Form->input('renglones_max', array('label'=>'Máxima cantidad de renglones', 'after'=>'Éste parámetro es útil cuando se selecciona MultiCell (múltiples renglones)'));

        echo "<hr>";

       echo $this->Form->input('character_type', array('options'=>$character_types, 'empty'=>'Seleccione'));
        echo $this->Form->input('related_field_table_select', array('label'=>'Nombre del campo en Base de Datos', 'options'=>$fieldTableList, 'empty'=>'Seleccione el dato que desea mostrar'));


        // solo mi usuario puede ver esto
        if ($session->read('Auth.User.username') == 'alevilar') :


            echo $this->Form->input('related_field_table', array('label'=>'Nombre del campo en Base de Datos','before'=>'AVAZADO - Aca se deberá escribir el nombre del campo en la tabla de la base de datos que hace referencia a este campo. Si no se escribe nada quiere decir que el campo merece un tratamiento especial yserá intercepatado y tatado desde la prograamación del código fuente.'));

            echo "<hr>";
            echo $this->Form->input('test_print_text',array('label'=>'Texto a imprimir para realizar pruebas de impresión', 'value'=>'AEIOUAEIOU','before'=>'Lo que se escriba aca será utilizado en la impresión de prueba del formulario. O sea, cuando se mprima un ejemplo para conocer cmo quedaria, el ejemlo se imprime con este texto.'));

            echo "<hr>";
            echo $this->Form->input('continue_field_coordenate_id', array('empty'=>'Ninguno (si no entra, escribir solo el texto que entra y listo)','label'=>'¿En que campo continuar escribiendo?','after'=>'<br>Indicar donde continuar escribiendo, en caso de que el texto no entrara en solo este campo del formulario. (hay veces en que uno desea seguir escribiendo en el reverso de la hoja, por ejemplo)','options'=>$fieldCoordenates));
            echo "<hr>";
            echo $this->Form->input('description');
        endif;
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Coordenates', true)), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Creators', true)), array('controller' => 'field_creators', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Creator', true)), array('controller' => 'field_creators', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Field Types', true)), array('controller' => 'field_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Field Type', true)), array('controller' => 'field_types', 'action' => 'add')); ?> </li>
    </ul>
</div>