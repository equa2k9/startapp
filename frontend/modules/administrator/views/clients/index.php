<?php $this->renderPartial('_create', array('model' => new Clients()), FALSE);?>
<div class="page-header">
    <h2>
        Clients
        <?php
        $this->widget(
            'bootstrap.widgets.TbButton', array(
                'label' => 'Add new client',
                'context' => 'info',
                'htmlOptions' => array(
                    'class' => 'pull-right',
                    'data-toggle' => 'modal',
                    'data-target' => '#create-client',
                ),
            )
        );
        ?>
        </h2>
       </div>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'type'=>'striped bordered condensed',
    'dataProvider' => $model->search(),
    'id'=>'all-clients',
    'template' => "{items}",
    'columns' => array(
        'id',
        'name',
        'phone',
        'email',
        'created_at',
         array(
             'htmlOptions' => array('nowrap' => 'nowrap'),
             'template'=>'{view}{delete}',
             'class' => 'booster.widgets.TbButtonColumn',
             'viewButtonUrl' => 'Yii::app()->createUrl("administrator/clients/view/$data->id")',
         ),
    ),
));