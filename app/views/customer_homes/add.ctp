<div class="customerHomes form">
<?php echo $this->Form->create('CustomerHome');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Customer Home', true)); ?></legend>
	<?php
                echo $this->Form->hidden('customer_id');
                echo $this->Form->input('type');
                
		echo $this->Form->input('address');
		echo $this->Form->input('number');
		echo $this->Form->input('floor');
		echo $this->Form->input('apartment');
		echo $this->Form->input('postal_code');
		

                echo $this->Form->input('city');
                echo $this->Form->input('county');
                echo $this->Form->input('state');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>