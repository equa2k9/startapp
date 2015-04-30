<?php
$not_activated = ($model->is_activated == Users::IS_NOT_ACTIVATED);
?>

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
        else
        {
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'label' => 'Rates',
                'context' => 'info',
                'url' => Yii::app()->createUrl('administrator/dashboard/driverRates', array('id' => $model->id)),
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
<?php
$this->widget('bootstrap.widgets.TbAlert', array(
//    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
    ),
));
?>
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
        'image' => array('type' => 'raw', 'name' => 'image', 'value' => CHtml::image(Yii::getPathOfAlias('uploads') . '/avatars/' . $model->photo)),
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
        'driversInfo.dependent'
    ),
));
?>
<h2>Files:</h2>
<hr>
<?php
foreach ($model->driversFiles as $file)
{
    echo $file->name . '<br>';
}


