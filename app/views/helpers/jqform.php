<?php
App::import('Helper','Form');
/**
 * Usa datePicker, un plugin de jquery.
 * para este Helper me guie del bakery:
 * http://bakery.cakephp.org/articles/view/transparent-datepicker-with-jquery
 *
 * pero le hice unos cambios para adaptar el Helper de Cake
 * a mis gustos y antojos
 *
 *
 */
class JqformHelper extends FormHelper {
    var $helpers = array('Html','Javascript', 'Form');
    var $format = '%Y-%m-%d';

    function _setup() {
        $format = Configure::read('DatePicker.format');
        if($format != null) {
            $this->format = $format;
        }
    }
    

    function datePicker($fieldName, $options = array()) {
        $this->_setup();
        $this->setEntity($fieldName);
        $htmlAttributes = $this->domId($options);
        $divOptions['class'] = 'date';
        $options['type'] = 'date';
        $options['div']['class'] = 'date';
        $options['dateFormat'] = 'DMY';
        $options['minYear'] = isset($options['minYear']) ? $options['minYear'] : (date('Y') - 50);
        $options['maxYear'] = isset($options['maxYear']) ? $options['maxYear'] : (date('Y') + 10);

        $options['after'] = $this->Html->image('calendar.png', array('id'=> $htmlAttributes['id'],'style'=>'cursor:pointer'));
        
        if (isset($options['empty'])) {
            $options['after'] .= $this->Html->image('b_drop.png', array('id'=> $htmlAttributes['id']."_drop",'style'=>'cursor:pointer'));
        }
        $output = $this->input($fieldName, $options);
        $output .= $this->Javascript->codeBlock("datepick('" . $htmlAttributes['id'] . "','01/01/" . $options['minYear'] . "','31/12/" . $options['maxYear'] . "');");
        return $output;
    } 
}