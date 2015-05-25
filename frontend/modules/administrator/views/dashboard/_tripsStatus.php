<h3>Trips statuses:
    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'label' => 'Add new trip status',
            'context' => 'info',
            'htmlOptions' => array(
                'class' => 'pull-right',
                'data-toggle' => 'modal',
                'data-target' => '#create-trips-status',
            ),
        )
    );
    ?>
</h3>

<hr>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter' => $tripsStatus,
    'id' => 'trips-status',
    'fixedHeader' => false,
    'responsiveTable' => true,
    'type' => 'striped bordered condensed',
    'dataProvider' => $tripsStatus->search(),
    'template' => "{items}",
    'columns' => array(
        'id' => array('name' => 'id',
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '9%;')
        ),
        array(
            'name' => 'description',
            'value' => '$data->description',
            'class' => 'booster.widgets.TbEditableColumn',
            'sortable' => true,
            'type' => 'raw',
//            'headerHtmlOptions' => array('width' => '37%;'),
            'filter' => false,
            'editable' => array(
                'type' => 'text',
                'url' => Yii::app()->createUrl("administrator/dashboard/updateTripsStatus")
            )
        ),
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'template' => '{delete}',
            'class' => 'booster.widgets.TbButtonColumn',
            'deleteButtonUrl'=>'Yii::app()->createUrl("administrator/dashboard/deleteTripsStatus",array("id"=>$data->id))'

        )
    ),
));