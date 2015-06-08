<h3>Route sheets statuses:
    <?php
    $this->widget(
            'bootstrap.widgets.TbButton', array(
        'label' => 'Add new route status',
        'context' => 'info',
        'htmlOptions' => array(
            'class' => 'pull-right',
            'data-toggle' => 'modal',
            'data-target' => '#create-route-status',
        ),
            )
    );
    ?>
</h3>

<hr>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter' => $routeStatus,
    'id' => 'route-status',
    'fixedHeader' => false,
    'responsiveTable' => true,
    'type' => 'striped bordered condensed',
    'dataProvider' => $routeStatus->search(),
    'template' => "{items}",
    'columns' => array(
        'id' => array('name' => 'id',
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '9%;')
        ),
        array(
            'name' => 'description',
            'value' => '$data->description',
            'sortable' => true,
            'type' => 'raw',
            'class' => 'booster.widgets.TbEditableColumn',
//            'headerHtmlOptions' => array('width' => '37%;'),
            'filter' => false,
            'editable' => array(
                'type' => 'text',
                'url' => Yii::app()->createUrl("administrator/dashboard/updateRouteStatus")
            )
        ),
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'template' => '{delete}',
            'class' => 'booster.widgets.TbButtonColumn',
            'deleteButtonUrl' => 'Yii::app()->createUrl("administrator/dashboard/deleteRouteStatus",array("id"=>$data->id))'
        )
    ),
));
