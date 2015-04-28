<div class="page-header">
    <h2>
        View Driver<small> №<?php echo $model->id ?></small>
    </h2>
</div>
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
));?>
<h2>Files:</h2>
<hr>
<?php
foreach($model->driversFiles as $file)
{
    echo $file->name.'<br>';
}


