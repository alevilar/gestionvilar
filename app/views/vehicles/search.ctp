
<div  id="customer-and-vehicle-list" class="span-24 last">
    <?php echo $this->element('buscador'); ?>
    
    <?php echo $this->element('customer_index'); ?>

   <? echo $this->element('vehicles_from_customer', $vehicles);?>
</div>
<?
echo $this->Js->writeBuffer();
?>


<script type="text/javascript">
    $('.hover-highlight').hover(function() {
        $(this).addClass('li-hover');
    }, function() {
        $(this).removeClass('li-hover');
    });

</script>



