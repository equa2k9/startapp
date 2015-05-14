<div class="page-header">
    <h2>
        All Drivers <?php echo ($this->action->id == 'forms') ? 'Forms' : '' ?>
    </h2>
</div>
<div class="clearfix"></div>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter' => $model,
    'id' => 'all_drivers',
    'fixedHeader' => false,
    'responsiveTable' => true,
    'type' => 'striped bordered condensed',
    'dataProvider' => ($this->action->id == 'forms') ? $model->searchforms() : $model->search(),
    'template' => "{items}",
    'columns' => array(
        'id' => array('name' => 'id',
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '9%;')
        ),
        array(
            'name' => 'fullname',
            'value' => '$data->driversInfo ? $data->driversInfo->fullname: $data->username',
            'sortable' => true,
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '37%;'),
            'filter' => CHtml::activeTextField($model, 'fullname', array('class' => 'form-control')),
        ),
        array('name' => 'dependent',
            'value' => '$data->driversInfo ? $data->driversInfo->dependent : " "',
            'type' => 'raw',
            'sortable' => TRUE,
            'filter' => CHtml::activeDropDownList($model, 'dependent', DriversInfo::model()->dependence, array('empty' => '', 'class' => 'form-control')),
            'headerHtmlOptions' => array('width' => '11%;')
        ),
        'email',
        'created_at' => array(
            'name' => 'created_at',
            'sortable' => true,
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '14%;'),
            'value' => 'date("m/d/Y h:i:s A","$data->created_at")'
        ),
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'template' => '{view}{delete}',
            'class' => 'booster.widgets.TbButtonColumn',
            'viewButtonUrl' => 'Yii::app()->createUrl("administrator/drivers/view/$data->id")',
        )
    ),
));


