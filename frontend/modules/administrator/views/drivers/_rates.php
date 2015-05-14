<div class="col-md-5">
    <h3>Rates:<?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => 'Add new rate',
            'context' => 'info',
            'htmlOptions' => array(
                'class' => 'pull-right',
                'data-toggle' => 'modal',
                'data-target' => '#rates',
            ),
            'visible' => !$not_activated
                )
        );
        ?></h3>
    <hr>
    <?php
    $this->widget('booster.widgets.TbExtendedGridView', array(
        'fixedHeader' => false,
        'id' => 'table-rates',
//            'headerOffset' => 40,
        // 40px is the height of the main navigation at bootstrap
        'type' => 'striped bordered condensed',
        'dataProvider' => $rates,
        'responsiveTable' => true,
        'htmlOptions' => array('style' => 'padding-top: 0!important;'),
        'template' => "{items}",
        'columns' => array(
            'id',
            'client_id' => array(
                'name' => 'client_id',
                'value' => '$data->client->name'
            ),
            'rate' => array(
                'name' => 'rate',
                'visible' => $model->driversInfo->dependent == DriversInfo::DRIVER_DEPENDENT
            ),
            'percentage' => array(
                'name' => 'percentage',
                'visible' => $model->driversInfo->dependent == DriversInfo::DRIVER_INDEPENDENT
            ),
            array(
                'htmlOptions' => array('nowrap' => 'nowrap'),
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("administrator/drivers/deleteRate/".$data->id)',
            ),
        ),
        'afterAjaxUpdate' => 'js: function(data){updatePage()}',
            )
    );
    ?>
</div>