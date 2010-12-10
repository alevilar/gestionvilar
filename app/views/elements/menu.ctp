<div id="menu">

    <div class="span-2">
        <?php
        $imgFastCar = $this->Html->image('home.png');
        echo $this->Html->link($imgFastCar, '/', array(
                        'escape' => false,
                        'title' => 'Ir al Inicio',
                    ));
        ?>
    </div>
    

    <div class="span-2">
        <?php
        $imguserAdd = $this->Html->image('user_add.png');
        echo $this->Html->link($imguserAdd, '/customers/edit', array(
                        'escape' => false,
                        'title' => __('Add Customer',true),
                    ));
        ?>
    </div>

    
    <div class="span-2">
        <?php
        $imgFastCar = $this->Html->image('pdf.png');
        echo $this->Html->link($imgFastCar, 'javascript: ;', array(
                        'escape' => false,
                        'title' => 'Imprimir Formulario Rápido',
                        'onclick' => 'seleccionarFormulario(0)',
                    ));
        ?>
    </div>
    
    <div class="span-2">
        <?php
        $imgAyuda = $this->Html->image('ayuda.png');
        echo $this->Html->link($imgAyuda, '/pages/ayuda', array(
                        'escape' => false,
                        'title' => __('Help',true),
                    ));
        ?>
    </div>
    <?php echo $this->element('vehicle_generic_avaliable_forms') ?>



    <div class="span-8 center">
        <div id="gestaform_data">
            <?php echo sprintf('%s: %s<br>%s '. GESTAFORM_VERSION_DAY,
                            __('System Version', true),
                            $html->link(GESTAFORM_VERSION,'/pages/notas_de_version',array('escape'=>false, 'title'=>'version details', 'class'=>'version_details')),
                            __('release date',true))?>
        </div>

        <?php
//        echo $html->link('PROBÁ LA VERSIÓN 1.0 beta','http://gestion.z-a.com.ar/gestionvilar/', array(
//        'style'=> 'color: #DEC944;',
//        ))
                ?>

        <?php echo $html->link('Volver a la version 0.9','http://gestion.z-a.com.ar/', array(
        'style'=> 'color: #DEC944;',
        ))?>
        
    </div>
    
    <ul class="menu span-7 last">
        <li><? echo $this->Html->link(sprintf('<span>%s</span>',__('Configurations',true)), '/', array('class'=>'parent', 'escape'=>false)); ?>
            <div>
                <ul>
                    <li><? echo $this->Html->link(__('Add User',true),'/users/add');?></li>
                    <li><? echo $this->Html->link(__('List Users',true),'/users/index');?></li>
                    <li><? echo $this->Html->link(__('Logout',true),'/users/logout');?></li>
                    <hr />
                    <li><? echo $this->Html->link(__('List Printers',true),'/printers');?></li>
                    <hr />
                    <li><? echo $this->Html->link( __('Characters',true),'/characters/index');?></li>
                    <li><? echo $this->Html->link(sprintf(__('Add %s',true), __('Generic Character',true)),'/characters/add');?></li>
                    <hr />
                    <li><? echo $this->Html->link(__('Agents',true),'/agents/index');?></li>
                    <li><? echo $this->Html->link(__('Identification Types',true),'/identification_types/index');?></li>
                    <li><? echo $this->Html->link(__('Character Types',true),'/character_types/index');?></li>
                </ul>
            </div>
        </li>
        <li><? echo $this->Html->link(sprintf('<span>%s</span>',__('Advanced',true)), '/', array('class'=>'parent', 'escape'=>false)); ?>
            <div>
                <ul>
                    <li><? echo $this->Html->link(__('Field Coordenates',true),'/field_coordenates');?></li>
                    <li><? echo $this->Html->link(__('Forms',true),'/field_creators/index');?></li>
                    <li><? echo $this->Html->link(__('Test Fields',true),'/field_creators/testForm');?></li>
                </ul>
            </div>
        </li>
    </ul>



</div> <!-- End Menu -->