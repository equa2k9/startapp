<?php
$not_activated = ($model->is_activated == Users::IS_NOT_ACTIVATED);
?>
<?php $this->renderPartial('_rates',array('modelDriver'=>$model,'model'=>new DriversRate()),FALSE);?>
<div class="page-header">
    <h2>
        View Driver <?php echo ($not_activated) ? 'Form <small> №' . $model->id : $model->id ?></small>
        <?php
        if ($not_activated)
        {
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'label' => 'Enroll this driver',
                'context' => 'warning',
                'url' => Yii::app()->createUrl('administrator/dashboard/enrollDriver', array('id' => $model->id)),
                'buttonType' => 'link',
                'htmlOptions' => array(
                    'class' => 'pull-right',
                ),
//                'visible' => $visible
                    )
            );
        }
        ?>  
    </h2>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>Main information:</h3>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbEditableDetailView', array(
            'data' => $model,
//'mode' => 'inline',
            'disabled' => true,
            //you can define any default params for child EditableFields 
//    'url' => $this->createUrl('updateUser'), //common submit url for all fields
//    'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
            'emptytext' => 'no value',
            'apply' => false, //you can turn off applying editable to all attributes
            'attributes' => array(
                'image' => array(
                    'type' => 'raw',
                    'name' => 'image',
                    'value' => CHtml::image(Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/avatars/' . $model->photo)
                    ,'',array('class'=>"img-responsive"))
                ),
                'username',
                'email',
                'driversInfo.fullname',
                'driversInfo.adress',
                'driversInfo.phone',
                'driversInfo.company',
                'driversInfo.company_adress',
                'driversInfo.company_years',
                'driversInfo.work_history',
                'driversInfo.supervisor_name',
                'driversInfo.supervisor_contact',
                'driversInfo.worked_from',
                'driversInfo.worked_to',
                'driversInfo.leaving_reason',
                'driversInfo.dependent' => array(
                    'name' => 'driversInfo.dependent',
                    'value' => ($model->driversInfo->dependent == DriversInfo::DRIVER_DEPENDENT) ? 'Dependent' : 'Independent'
                )
            ),
        ));
        ?>
    </div>

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
            'fixedHeader' => true,
            'headerOffset' => 40,
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
                )
        );?>

    </div>

    <div class="col-md-3">
        <h3>Files:</h3>
        <hr>


            <?php foreach ($model->driversFiles as $file):?>

                <?php echo CHtml::link($file->name,Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/drivers_files/' . $file->users_id.'/'.$file->file))?>
                <hr>
            <?php endforeach?>


    </div>
</div>