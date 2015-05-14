<div class="col-md-4">
    <h3>Main information:</h3>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbEditableDetailView', array(
        'data' => $model,
        'mode' => 'inline',
        'disabled' => false,
        'url' => $this->createUrl('update'), //common submit url for all fields
        'emptytext' => 'no value',
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
            'driversInfo.fullname',
            'driversInfo.address',
            'driversInfo.phone',
            'driversInfo.company',
            'driversInfo.company_adress',
            'driversInfo.company_years',
            'driversInfo.work_history',
            'driversInfo.supervisor_name',
            'driversInfo.supervisor_contact',
            array(
                'label' => 'Worked from',
                'type' => 'raw',
                'value' => $this->widget('booster.widgets.TbEditableField', array(
                    'type' => 'date',
                    'viewformat' => 'mm/dd/yyyy',
                    'format' => 'mm/dd/yyyy',
                    'model' => $model,
                    'mode' => 'popup',
                    'attribute' => 'driversInfo.worked_from',
                    'url' => $this->createUrl('update'), //url for submit data
                    'source' => $model->driversInfo->worked_from,
                        ), true),
            ),
            array(
                'label' => 'Worked to',
                'type' => 'raw',
                'value' => $this->widget('booster.widgets.TbEditableField', array(
                    'type' => 'date',
                    'viewformat' => 'mm/dd/yyyy',
                    'format' => 'mm/dd/yyyy',
                    'model' => $model,
                    'mode' => 'popup',
                    'attribute' => 'driversInfo.worked_to',
                    'url' => $this->createUrl('update'), //url for submit data
                    'source' => $model->driversInfo->worked_to,
                        ), true),
            ),
            'driversInfo.leaving_reason',
            array(
                'label' => 'Drivers depend',
                'type' => 'raw', 'value' => $this->widget('booster.widgets.TbEditableField', array(
                    'type' => 'select',
                    'model' => $model,
                    'mode' => 'inline',
                    'attribute' => 'driversInfo.dependent',
                    'url' => $this->createUrl('update'), //url for submit data
                    'source' => $model->driversInfo->dependence,
                    'success' => 'js: function(response, newValue) {
  if (!response.success)
    $.fn.yiiGridView.update("table-rates");
    return true;
}'
                        ), true),
            ),
        ),
    ));
    ?>
</div>