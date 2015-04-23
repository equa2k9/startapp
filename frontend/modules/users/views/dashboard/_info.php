<?php
$this->widget('bootstrap.widgets.TbEditableDetailView', array(
    'data' => $model,
//'mode' => 'inline',
//    'disabled' => false,
    //you can define any default params for child EditableFields 
    'url' => $this->createUrl('updateUser'), //common submit url for all fields
//    'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
    'emptytext'  => 'no value',
//    'apply' => true, //you can turn off applying editable to all attributes
    'attributes' => array(
//        'image'=>array('type'=>'raw','name'=>'image','value'=> CHtml::image(Yii::getPathOfAlias('uploads').'/avatars/'.$model->photo)),
        'username',
        'email',                
    ),
));




