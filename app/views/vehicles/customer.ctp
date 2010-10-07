<?
/* @var $this View */
?>
<script type="text/javascript">
    var customer = <?php echo json_encode($customer['Customer'])?>;
</script>

<? echo $this->element('vehicles_from_customer', $vehicles);?>

<?
if (count($vehicles) == 0) {
    echo "<div class='notice span-12 last'>"
            .__('This customer has no vehicles',true)
            ." "
            .$this->Html->link('haga click aquí para agregar uno','/vehicles/add/'.$customer['Customer']['id'])
            ."</div>";
}
?>
