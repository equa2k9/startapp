
    <div class="col-md-5">
        <h3>Passengers:</h3>
        <hr>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'all-passengers',
    'dataProvider' => $passengers->search(),
    'responsiveTable' => true,
    'htmlOptions' => array('style' => 'padding-top: 0!important;'),
    'template' => "{items}",
    'columns' => array(
        'id',
        'name',
        'phone',
        'email',
        'pickup_number',
        'dropoff_number',
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("administrator/clients/deletePassengers/".$data->id)',
        ),
    ),
));?>
        </div>
    </div>