<?
/* @var $this View */


?>

<? echo $this->element('vehicles_from_customer', array('vehicles' =>$vehicles) );?>

<?
if (count($vehicles) == 0) {
    echo "<div class='notice span-12 last'>"
            .__('No vehicles',true)
            ."</div>";
}
?>
