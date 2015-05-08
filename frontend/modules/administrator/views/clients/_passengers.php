
    <div class="col-md-6">
<?php
//var_dump($passengers);exit;
$this->widget('booster.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
//    'ajaxUpdate'=>false,
    'ajaxUrl' => $this->createUrl('clients'),
    'dataProvider' => $passengers->search(),
    'responsiveTable' => true,
    'htmlOptions' => array('style' => 'padding-top: 0!important;'),
    'template' => "{items}{pager}",
    'columns' => array(
        'id',
        'name',
        'phone',
        'email',
        'pickup_number',
        'dropoff_number'
    ),
));?>
        </div>
    </div>