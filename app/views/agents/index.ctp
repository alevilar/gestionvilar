<div class="agents index">
    <h2><?php __('Agents');?></h2>

    <div class="actions span-7">
        <h3><?php __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Agent', true)), array('action' => 'add')); ?></li>
            <li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Identification Types', true)), array('controller' => 'identification_types', 'action' => 'index')); ?> </li>
            <li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Identification Type', true)), array('controller' => 'identification_types', 'action' => 'add')); ?> </li>
        </ul>
    </div>

    <table cellpadding="0" cellspacing="0" class="span-17 last">
        <tr>
            <th><?php echo $this->Paginator->sort('first_name');?></th>
            <th><?php echo $this->Paginator->sort('surname');?></th>
            <th><?php echo $this->Paginator->sort(__('Identification',true),'identification_number');?></th>
            <th><?php echo $this->Paginator->sort('address');?></th>
            <th><?php echo $this->Paginator->sort('city');?></th>
            <th class="actions">&nbsp;</th>
        </tr>
        <?php
        $i = 0;
        foreach ($agents as $agent):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
        <tr<?php echo $class;?>>
            <td><?php echo $agent['Agent']['first_name']; ?>&nbsp;</td>
            <td><?php echo $agent['Agent']['surname']; ?>&nbsp;</td>
            <td>
                <?php echo $agent['IdentificationType']['name']. ": ".$agent['Agent']['identification_number']; ?>&nbsp;
            </td>
            <td><?php echo $agent['Agent']['address']." ".$agent['Agent']['address_number']. " Dpto:".$agent['Agent']['address_floor']. " ".$agent['Agent']['address_apartment']; ?>&nbsp;</td>

            <td><?php echo $agent['Agent']['city']; ?>&nbsp;</td>
            <td class="span-2">
                    <?php echo $this->Html->link(__('View', true), array('action' => 'view', $agent['Agent']['id'])); ?><br>
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $agent['Agent']['id'])); ?><br>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $agent['Agent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $agent['Agent']['id'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
        ));
        ?>	</p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
        |
        <?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>
