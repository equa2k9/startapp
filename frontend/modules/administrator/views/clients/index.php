<div class="page-header">
    <h2>
        Clients
        </h2>
       </div>
<?php
$this->widget('booster.widgets.TbExtendedGridView', array(
    'filter'=>$model,
    'type'=>'striped bordered condensed',
    'dataProvider' => $model->search(),
    'selectableRows' => 0,
    'template' => "{items}",
    'columns' => array(
        array(
            'class'=>'booster.widgets.TbRelationalColumn',
            'url' => $this->createUrl('clientsRate'),
            'value'=> '"show"',
            'afterAjaxUpdate' => 'js:function(tr,rowid,data){

            }'
        ),
        'id',
        'name',
        'phone',
        'email',
        'created_at'
    ),
));