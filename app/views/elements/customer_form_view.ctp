
<div class="clear">
<h2><? __('Customer')?></h2>
<dl>
    <dt><? __('name')?></dt>
    <dd><?= $customer['name']?></dd>
    <dt>Tipo y N° Doc</dt>
    <dd><?= $customer['Identification']['IdentificationType']['name'] . ' ' . $customer['Identification']['number']?></dd>
</dl>
<h3><? __('Customer Home')?></h3>
<?
    $chomes = array('address'=>'','number'=>'','city'=>'');
    foreach ($customer['CustomerHome'] as $ch) {
        if ($ch['type'] == 'Legal') {
            $chomes['address'] = $ch['address'];
            $chomes['number'] = $ch['number'];
            $chomes['city'] = $ch['city'];
        }
    }
?>
<dl>
    <dt><? __('Address')?></dt>
    <dd><?= $chomes['address']?></dd>
    <dt><? __('Number')?></dt>
    <dd><?= $chomes['number']?></dd>
    <dt><? __('City');?></dt>
    <dd><?= $chomes['city']?></dd>
    
</dl>
</div>
