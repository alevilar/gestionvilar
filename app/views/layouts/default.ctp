<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Sistema Gestión de Formularios Online
            <?php echo $title_for_layout; ?>
        </title>


        <script src="http://www.google.com/jsapi?key=ABQIAAAAErkyFeQ8Jgi7dGtuUm-4NRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxSq5q8AeA0IXY0-a3IRWti3SYTIBw" type="text/javascript"></script>

        <!-- ONLINE
        <script src="http://www.google.com/jsapi?key=ABQIAAAAErkyFeQ8Jgi7dGtuUm-4NRTu_qIQxv8He_1EOq-W7S0AA_D05BQ4fwaRVSb5zQycCg3yhvLjM-wCTA" type="text/javascript"></script>
        -->

        <?php
        echo $this->Html->meta('icon');



        ////////////    BLUEPRINP CSS FRAMEWORK   //////////////
        echo $this->Html->css('blueprint/screen');
        echo $this->Html->css('blueprint/print', null, array('media'=>'print'));
        ?>
        <!--[if lt IE 8]>
        <? echo $this->Html->css('blueprint/ie');?>
        <![endif]-->
        <?
        echo $this->Html->css('blueprint/plugins/fancy-type/screen');
        echo $this->Html->css('blueprint/plugins/buttons/screen');
        echo $this->Html->css('jqueryuithemes/pepper-grinder/custom');
        ////////////////////////////////////////////////////////



        echo $this->Html->script(array(
            'jquery',
            'date',
            'jquery.datePicker', // calendario usado en input date
            'cake.datePicker',   // calendario en input tipo date
            'menu',
            'jquery.form',
            'jquery.form.wizard',
            'jquery.history',
            'jquery.validate',
            'jquery.blockUI',
            'jquery.cakeFormFill',
            'jquery.populate',
            'default',
            'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js',
        ));
        echo $this->Html->css(array('datePicker.css'));
        // DatePicker end

        echo $this->Html->css(array(
            'menu.css',
            ));

        ?>
        <!-- // para evitar problemas con IE y el z.index de los selects y el datePicker -->
        <!--[if IE]><?= $this->Html->script( 'jquery.bgiframe'); ?><![endif]-->
        <?

        echo $this->Html->css('gestionvilar');

        // echo $this->Javascript->link('jquery');

        echo $scripts_for_layout;

        echo $js->writeBuffer();
        ?>

    </head>
    <body>
        <?php echo $this->Html->image('background.jpg', array('id'=>'background'))?>
        <div id="container" class="container">
            <div id="header" class="span-24 last">
                <div class="span-24 last">
                    <?php echo $this->element('menu'); ?>
                </div>
                <div id="mensajero" class="span-11 last">
                    <?php
                    echo $this->Session->flash();
                    echo $session->flash('auth');
                    ?>
                </div>
            </div> <!-- End Header -->

            <div id="content" class="span-24 last transparent-low bborder">
                <?php echo $content_for_layout; ?>
            </div>

            <div id="footer">
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>

    

    <script type="text/javascript">
        $(document).ready(function(){
            $('a[href="http://apycom.com/"]').hide();

        $(document).ajaxStart(function(){
            $.blockUI({message:'<h1>Cargando...</h1>'})
        }).ajaxStop($.unblockUI);


           //        $.unblockUI();
        });
    </script>
</html>