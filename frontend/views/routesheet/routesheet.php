<div class="page-header">
    <h2>
        Route Sheets<small></small>
    </h2>
</div>
<?php
$buttons = '{view}';
$visible = false;

if (Yii::app()->user->role == Users::ROLE_ADMIN || Yii::app()->user->role == Users::ROLE_DISPATCHER)
{
    $buttons.='{delete}';
    $visible = true;
}
$this->widget(
        'bootstrap.widgets.TbButton', array(
    'label' => 'Create',
    'context' => 'primary',
    'htmlOptions' => array(
        'class' => 'pull-right'
    ),
    'visible' => $visible
        )
);
?>
<div class="clearfix"></div>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter' => $model,
    'id' => 'routesheet',
    'fixedHeader' => false,
    'responsiveTable' => true,
//    'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'columns' => array(
        'id' => array('name' => 'id',
            'value' => function($data, $raw) {
                return 'Routesheet ' . $data->id;
            },
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '9%;')
        ),
        'users_fullname' => array(
            'name' => 'users_fullname',
            'value' => '$data->users->driversInfo ? $data->users->driversInfo->fullname: $data->users->username',
            'sortable' => true,
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '37%;'),
            'filter' => CHtml::activeTextField($model, 'users_fullname', array('class' => 'form-control')),
        ),
        'waybill_id',
        'status_id' => array('name' => 'status_id',
            'value' => '$data->status->description',
            'type' => 'raw',
            'sortable' => TRUE,
            'filter' => CHtml::activeDropDownList($model, 'status_id', RoutesheetStatus::getStatus(), array('empty' => '', 'class' => 'form-control')),
//                    'htmlOptions' => array('style' => 'text-align: center;'),
            'headerHtmlOptions' => array('width' => '11%;')
        ),
        'created_at' => array(
            'name' => 'created_at',
            'sortable' => true,
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '14%;')
        ),
        'updated_at' => array(
            'name' => 'updated_at',
            'sortable' => true,
            'headerHtmlOptions' => array('width' => '14%;')
        ),
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $buttons,
            'viewButtonUrl' => 'Yii::app()->createUrl(Yii::app()->controller->module->id."/routesheet/view/".$data->id)',
            'deleteButtonUrl' => 'Yii::app()->createUrl(Yii::app()->controller->module->id."/routesheet/delete/".$data->id)',
        ),
    ),
));


