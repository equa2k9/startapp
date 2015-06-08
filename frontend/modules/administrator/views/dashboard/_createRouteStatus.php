<?php
$this->beginWidget(
        'booster.widgets.TbModal', array('id' => 'create-route-status')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add new Routesheet status</h4>
</div>

<div class="modal-body">
    <?php
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'route-status-form',
        'action' => Yii::app()->createUrl('administrator/dashboard/createRouteStatus'),
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well', 'validateOnSubmit' => false), // for insert effect
            )
    );
    ?>
    <div class="clearfix"></div>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'description') ?>
    </div>
</div>

<div class="modal-footer">

    <?php
    echo CHtml::ajaxSubmitButton(
            'Save', Yii::app()->createUrl('administrator/dashboard/createRouteStatus'), array(
        'type' => 'POST',
        'data' => 'js:$("#route-status-form").serialize()',
        'success' => 'js:function(data){
            var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                {
                    $("#yw0").click();
                    $.fn.yiiGridView.update("route-status");
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
<?php
$this->endWidget();
$this->endWidget();
?>

