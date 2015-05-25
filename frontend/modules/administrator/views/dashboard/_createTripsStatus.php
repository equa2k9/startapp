<?php
$this->beginWidget(
    'booster.widgets.TbModal', array('id' => 'create-trips-status')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add new Trips status</h4>
</div>

<div class="modal-body">
    <?php
    $form = $this->beginWidget(
        'booster.widgets.TbActiveForm', array(
            'id' => 'trips-status-form',
            'action' => Yii::app()->createUrl('administrator/dashboard/createTripsStatus'),
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
        'Save', Yii::app()->createUrl('administrator/dashboard/createTripsStatus'), array(
        'type' => 'POST',
        'data' => 'js:$("#trips-status-form").serialize()',
        'success' => 'js:function(data){
            var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                {
                    $("#yw1").click();
                    $.fn.yiiGridView.update("trips-status");
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

