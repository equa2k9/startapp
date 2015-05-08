<?php

$this->widget('bootstrap.widgets.TbEditableDetailView', array(
    'data' => $model,
//'mode' => 'inline',
    'disabled' => true,
    //you can define any default params for child EditableFields 
    'url' => $this->createUrl('updateUser'), //common submit url for all fields
//    'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
    'emptytext' => 'no value',
    'apply' => false, //you can turn off applying editable to all attributes
    'attributes' => array(
        'image' => array(
            'type' => 'raw',
            'name' => 'image',
            'value' => CHtml::image((file_exists(Yii::getPathOfAlias('uploads') . '/avatars/' . $model->photo)?
                Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/avatars/' . $model->photo):
                Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/avatars/avatar_blank.png'))),
                '',array('class' => "img-responsive")
        ),
        'username',
        'email',
    ),
));




