<div class="page-header">
    <h2>
        <?php echo Yii::t('site','View user: ').$model->username?>
    </h2>
</div>
<div class="clearfix"></div>

    

        <?php
        $this->widget('bootstrap.widgets.TbEditableDetailView', array(
            'data' => $model,
            'mode' => 'inline',
    'disabled' => false,
            //you can define any default params for child EditableFields
            'url' => $this->createUrl('update'), //common submit url for all fields
//    'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
            'emptytext' => 'Введіть дані',
    'apply' => true, //you can turn off applying editable to all attributes
            'attributes' => array(
                'image' => array(
                'type' => 'raw',
                'name' => 'image',
                'value' => CHtml::image(Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/avatars/' . $model->photo)
                        , '', array('class' => "img-responsive"))
            ),
            'username',
            'email',
                array('label' => 'Роль користувача',
                    'type' => 'raw', 'value' => $this->widget('booster.widgets.TbEditableField', array(
                        'type' => 'select',
                        'model' => $model,
                        'mode' => 'inline',
                        'attribute' => 'role',
                        'url' => $this->createUrl('update'), //url for submit data
                        'source' => array('administrator' => 'administrator', 'user' => 'user', 'banned' => 'banned'),
                            ), true),
//            CHtml::activeDropDownList($model, 'role', array('administrator'=>'administrator','user'=>'user','banned'=>'banned')))
                ),
        ), ));
        ?>

    

