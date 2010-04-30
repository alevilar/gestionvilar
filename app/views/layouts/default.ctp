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
            <?php __('CakePHP: the rapid development php framework:'); ?>
            <?php echo $title_for_layout; ?>
        </title>
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
        ////////////////////////////////////////////////////////



        
        // DatePicker JS y CSS
         echo $this->Javascript->link(array(
             'jquery.js',
             'date.js',
             'jquery.datePicker.js',
             'cake.datePicker.js',
            ));
        echo $this->Html->css(array('datePicker.css'));
        // DatePicker end

        ?>
        <!-- // para evitar problemas con IE y el z.index de los selects y el datePicker -->
        <!--[if IE]><?= $this->Javascript->link( 'jquery.bgiframe'); ?><![endif]-->
        <?

        

        echo $this->Html->css('gestionvilar');

       // echo $this->Javascript->link('jquery');

        echo $scripts_for_layout;
        ?>

    </head>
    <body>
        <div id="container" class="container showgrid">
            <div id="header" class="span-24 last">
                <h1><?php  __('Form Manager System'); ?></h1>
            </div>
            <div id="mesajero" class="span-24 last">
                <?php
                echo $this->Session->flash();
                ?>
            </div>
            <div id="content" class="span-18">

                <?php echo $content_for_layout; ?>

            </div>
            <div id="menu" class="span-6 last">

                <div class="box">
                    <h2 class="caps">Menu 1</h2>
                    <ul>
                        <li><? echo $this->Html->link(array('controller'=>'pages','action'=>'home'))?></li>

                        <li><? echo $this->Html->link('Add Customer',array('controller'=>'customers','action'=>'add'))?></li>
                        <li><? echo $this->Html->link('List Customer',array('controller'=>'customers','action'=>'index'))?></li>
                    </ul>

                     <ul>
                        <li><? echo $this->Html->link('Add User',array('controller'=>'users','action'=>'add'))?></li>
                        <li><? echo $this->Html->link('List Users',array('controller'=>'users','action'=>'index'))?></li>

                        <li><? echo $this->Html->link('List Identifications Types',array('controller'=>'identification_types','action'=>'index'))?></li>

                        <li><? echo $this->Html->link('Salir',array('controller'=>'users','action'=>'logout'))?></li>
                    </ul>
                </div>

            </div>
            <div id="footer">
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>