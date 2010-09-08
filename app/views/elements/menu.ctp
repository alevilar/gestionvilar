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
                    <li><? echo $this->Html->link(__('List Printers',true),'/printers');?></li>
                    <hr />
                    <li><? echo $this->Html->link( __('Characters',true),'/characters/index');?></li>
                    <li><? echo $this->Html->link(sprintf(__('Add %s',true), __('Generic Character',true)),'/characters/add_from_all');?></li>
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
                    <li><? echo $this->Html->link(__('Field Map',true),'/field_coordenates/mapear');?></li>
                    <li><? echo $this->Html->link(__('Test Fields',true),'/field_creators/testForm');?></li>
                </ul>
            </div>
        </li>
    </ul>
</div> <!-- End Menu -->