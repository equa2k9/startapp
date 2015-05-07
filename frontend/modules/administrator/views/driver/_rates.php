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
//            'headerOffset' => 40,
            // 40px is the height of the main navigation at bootstrap
            'type' => 'striped bordered condensed',
            'dataProvider' => $rates,
            'responsiveTable' => true,
            'template' => "{items}",
            'htmlOptions' => array('style' => 'padding-top: 0!important;'),
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
                    'deleteButtonUrl' => 'Yii::app()->createUrl("administrator/dashboard/deleteRate/".$data->id)',
                ),
            ),
            'afterAjaxUpdate'=>'js: function(){updatePage()}',
        )
    );
    ?>
</div>