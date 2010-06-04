<? //debug($customer)?>

<div class="column span-5 actions">
    <ul>
        <li>
            <?= $this->Html->link('Editar Cliente', '/customers/edit/'.$customer['Customer']['id']) ?>
        </li>
        <?php if ($customer['Customer']['type'] == 'natural'):?>
        <li>
                <?= $this->Html->link('Agregar Cónyuge', '/spouses/add/'.$customer['Customer']['id']) ?>
        </li>
        <?php endif;?>
        <li>
            <?= $this->Html->link('Agregar Apoderado', '/representatives/add/'.$customer['Customer']['id']) ?>
        </li>
    </ul>
</div>

<div class="customers view span-19 last">

    <?php $customerType =  $customer['Customer']['type']?>
    <h2><?php  echo sprintf(__('Customer %s: %s',true),$customer['Customer']['type'], $customer['Customer']['name']);?></h2>
    <dl><?php $i = 0;
        $class = ' class="altrow"';?>

        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Born'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $customer['Customer']['born']; ?>
            &nbsp;
        </dd>

         <?php if (!empty($customer['Identification'])):?>
            <?php if (!empty($customer['Identification']['IdentificationType'])):?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Identification'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['Identification']['IdentificationType']['name'] . ' ' . $customer['Identification']['number']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Authority Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['Identification']['authority_name']; ?>
            &nbsp;
        </dd>
        <?php endif;endif;?>

        <?php if ($customer['Customer']['type'] == 'natural'):?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['CustomerNatural']['first_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Surname'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['CustomerNatural']['surname']; ?>
            &nbsp;
        </dd>
            <?php if ( !empty($customer['CustomerNatural']['MaritalStatus'])):?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Marital Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $customer['CustomerNatural']['MaritalStatus']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nuptials'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $customer['CustomerNatural']['nuptials']; ?>
            &nbsp;
        </dd>
            <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nationality Type'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $nationalities[$customer['CustomerNatural']['nationality_type']]; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nationality'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $customer['CustomerNatural']['nationality']; ?>
            &nbsp;
        </dd>
        <?php else:?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['CustomerLegal']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inscription Entity'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['CustomerLegal']['inscription_entity']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inscription Number'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['CustomerLegal']['inscription_number']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inscription Date'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $customer['CustomerLegal']['inscription_date']; ?>
            &nbsp;
        </dd>
        <?php endif; ?>


        <?php
        if (!empty($customer['CustomerNatural']['Spouse'])):
            if (count($customer['CustomerNatural']['Spouse'] > 0)):
                foreach ($customer['CustomerNatural']['Spouse'] as $s):
                ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo $this->Html->link(sprintf(__('Edit %s',true), 'Cónyuge'),'/spouses/edit/'.$s['id']) ?></dt>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo $this->Html->link(sprintf(__('Delete %s',true), 'Cónyuge'),'/spouses/delete/'.$s['id'],null, 'Desea eliminar cónyuge: '.$s['name']) ?></dt>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Spouse Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $s['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Spouse Identification'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <?php echo $s['IdentificationType']['name'] . ' ' .$s['identification_number']; ?>
            &nbsp;
        </dd>
            <?php
                endforeach;
            endif;
        endif;
        ?>
    </dl>


    <div class="related">
        <?php if (!empty($customer['CustomerHome'])):?>
        <h3><?php __('Customer Homes');?></h3>
            <?php
            $i = 0;
            foreach ($customer['CustomerHome'] as $customerHome):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
        <b><?= 'Dirección: '.$customerHome['type']?></b>
        <dl>
            <dt><?php __('City'); ?></dt>
            <dd><?= $customerHome['city']?></dd>
            <dt><?php __('Address'); ?></dt>
            <dd><?= $customerHome['address']?></dd>
            <dt><?php __('Number'); ?></dt>
            <dd><?= $customerHome['number']?></dd>
            <dt><?php __('Floor'); ?></dt>
            <dd><?= $customerHome['floor']?></dd>
            <dt><?php __('Apartment'); ?></dt>
            <dd><?= $customerHome['apartment']?></dd>
            <dt><?php __('Postal Code'); ?></dt>
            <dd><?= $customerHome['postal_code']?></dd>
        </dl>
            <? endforeach;?>
        <?php endif;?>
    </div>

    <div class="related">
        <?php if (!empty($customer['Representative'])):?>
            <?php if (count($customer['Representative'])>0):?>
        <h3><?php __('Representative');?></h3>
                <?php
                $i = 0;
                foreach ($customer['Representative'] as $representative):
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>
        <dl>
            <dt><?php echo $this->Html->link(sprintf(__('Edit %s',true), 'Apoderado'),'/representatives/edit/'.$representative['id']) ?></dt>
            <dt><?php echo $this->Html->link(
                    sprintf(__('Delete %s',true), 'Apoderado'),
                    '/representatives/delete/'.$representative['id'], null,"¿Desea eliminar al apoderado: ".$representative['name'].' '.$representative['surname'].'?'); ?></dt>
            <dt><?php __('Name'); ?></dt>
            <dd><?= $representative['name']?></dd>
            <dt><?php __('Surname'); ?></dt>
            <dd><?= $representative['surname']?></dd>
            <dt><?php __('Identification'); ?></dt>
            <dd><?= @$representative['IdentificationType']['name']. ' '.$representative['identification_number']?></dd>
            <dt><?php __('Nationality'); ?></dt>
            <dd><?= @$nationalities[$representative['nationality_type']]?></dd>
            <dt><?php __('Country'); ?></dt>
            <dd><?= $representative['nationality']?></dd>
        </dl>
                <? endforeach;?>
            <?php endif;
        endif;?>
    </div>

</div>

