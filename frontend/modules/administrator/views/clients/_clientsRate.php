<div class="row">
<div class="col-md-6">
    <?php
    $this->widget('bootstrap.widgets.TbEditableDetailView', array(
        'data' => $clientsRate,
        'mode' => 'popup',
        'disabled' => false,
        'url' => $this->createUrl('updateClientRate'), //common submit url for all fields
        'emptytext' => 'no value',
        'apply' => true, //you can turn off applying editable to all attributes
        'attributes' => array(
            'total_rate',
            'total_mile',
            'per_mile',
            'ambulatory',
            'wheelchair'
        )));
    ?>
</div>
