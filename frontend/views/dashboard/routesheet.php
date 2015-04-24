<?php

$this->widget('yiiwheels.widgets.grid.WhGridView', array(
    'filter' => $model,
    'fixedHeader' => true,
    'responsiveTable' => true,
    'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'template' => "{items}",
    'columns' => array(
        'id' => array('name' => 'id',
            'value' => function($data, $raw) {
                return 'Routesheet ' . $data->id;
            },
            'type' => 'raw'),
        'users.username',
        'waybill_id',
        'status.description',
        'created_at',
        'updated_at',
    ),
));

