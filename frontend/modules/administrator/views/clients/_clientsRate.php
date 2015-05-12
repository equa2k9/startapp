<div class="col-md-3">
    <h3>Rates:</h3>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbEditableDetailView', array(
        'data' => $clientsRate,
        'mode' => 'popup',
        'disabled' => false,
        'url' => $this->createUrl('updateRate'), //common submit url for all fields
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
