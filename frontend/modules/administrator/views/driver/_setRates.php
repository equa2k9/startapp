<?php
$this->beginWidget(
        'booster.widgets.TbModal', array('id' => 'rates')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add new rate</h4>
</div>

<div class="modal-body">
    <?php
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'rates-form',
        'action' => Yii::app()->createUrl('administrator/dashboard/setRate'),
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well', 'validateOnSubmit' => false), // for insert effect
            )
    );
    ?>
    <div class="row">
        <?php
        echo $form->dropDownListGroup(
                $model, 'client_id', array(
            'widgetOptions' => array(
                'data' => Clients::getClients($modelDriver->id)
            )
                )
        );
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <?php
        if ($modelDriver->driversInfo->dependent == DriversInfo::DRIVER_DEPENDENT)
        {
            $model->setScenario('rate');
            echo $form->textFieldGroup($model, 'rate');
        }
        else
        {
            $model->setScenario('percentage');
            echo $form->textFieldGroup($model, 'percentage');
        }
        ?>
    </div>
    <?php echo $form->hiddenField($model, 'users_id', array('value' => $modelDriver->id)) ?>
</div>

<div class="modal-footer">

    <?php
    echo CHtml::ajaxSubmitButton(
            'Save', Yii::app()->createUrl('administrator/dashboard/setRate'), array(
        'type' => 'POST',
        'data' => 'js:$("#rates-form").serialize()',
        'success' => 'js:function(data){
            var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                {
                    $("#yw0").click();
                    $.fn.yiiGridView.update("yw3");
                    $("#rates").on("hidden.bs.modal", function () {
location.reload();
})
                }

            }'
            ), array('class' => 'btn btn-primary',)
    );
    ?>

    <?php
    $this->widget(
            'booster.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
            )
    );
    ?>

</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget();
?>

