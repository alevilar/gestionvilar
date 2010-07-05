<div class="printers form">
<?php echo $this->Form->create('Printer');?>
	<fieldset>
 		<legend><?php printf(__('Add %s', true), __('Printer', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('x', array('label'=>'Coordenada Horizontal - X','after'=>'<br>Indique cuantos milimetros desea mover la impresión en su línea horizontal. valores negativos significa que se moverá hacia la izquierda.<br><br>'));
		echo $this->Form->input('y', array('label'=>'Coordenada Vertical - Y','after'=>'<br>Indique cuantos milimetros desea moverla impresión en forma vertical. Valores negativos significa que semoverá hacia arriba<br>'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>