<div class="page-header">
    <h2>
        <?php echo Yii::t('site','Users')?>
    </h2>
</div>
<div class="clearfix"></div>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter' => $model,
    'id' => 'allUsers',
    'fixedHeader' => false,
    'responsiveTable' => true,
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'columns' => array(
        'id' => array('name' => 'id',
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '9%;')
        ),
        array(
            'name' => 'fullname',
            'value' => '$data->username',
            'sortable' => true,
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '37%;'),
            'filter' => CHtml::activeTextField($model, 'username', array('class' => 'form-control')),
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
//            'viewButtonUrl' => 'Yii::app()->createUrl("administrator/users/view/$data->id")',
        )
    ),
));



