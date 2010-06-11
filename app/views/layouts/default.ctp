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
        ?>

    </head>
    <body>
        <div id="container" class="container">
            <div id="header" class="span-24 last">
                <div class="span-10">
                    <div id="menu">
                        <ul class="menu">

                            <li>
                                <? echo $this->Html->link(
                                sprintf('<span>%s</span>',__('Customers',true)),
                                '/', array(
                                'class'=>'parent',
                                'escape'=>false)); ?>
                                <div>
                                    <ul>
                                        <li><?= $this->Html->link(__('Home',true),'/');?></li>
                                        <li><?= $this->Html->link(__('Add Customer',true),'/customers/edit');?></li>
                                        <li><?= $this->Html->link(__('Help',true),'/pages/ayuda');?></li>
                                    </ul>
                                </div>
                            </li>
                            <li><? echo $this->Html->link(sprintf('<span>%s</span>',__('Configurations',true)), '/', array('class'=>'parent', 'escape'=>false)); ?>
                                <div>
                                    <ul>
                                        <li><? echo $this->Html->link(__('Add User',true),'/users/add');?></li>
                                        <li><? echo $this->Html->link(__('List Users',true),'/users/index');?></li>
                                        <li><? echo $this->Html->link(__('Logout',true),'/users/logout');?></li>
                                        <hr />
                                        <li><? echo $this->Html->link(__('List Identification Types',true),'/identification_types/index');?></li>
                                        <li><? echo $this->Html->link(__('List Character Types',true),'/character_types/index');?></li>
                                        <hr />
                                        <li><? echo $this->Html->link(__('Inputs Config',true),'/field_coordenates');?></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- End Menu -->
                </div>
                <div id="mensajero" class="span-11 last">
                    <?php
                    echo $this->Session->flash();
                    ?>
                </div>
            </div> <!-- End Header -->

            <div id="content" class="span-24 last box transparent-low">
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