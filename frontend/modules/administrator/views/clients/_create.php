<?php
$this->beginWidget(
        'booster.widgets.TbModal', array('id' => 'create-client')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add new client</h4>
</div>

<div class="modal-body">
    <?php
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'clients-form',
        'action' => Yii::app()->createUrl('administrator/clients/create'),
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well', 'validateOnSubmit' => false), // for insert effect
            )
    );
    ?>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'name')?>

    </div>

    <div class="row">
        <?php echo $form->textFieldGroup($model,'phone')?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model,'email')?>
    </div>
</div>

<div class="modal-footer">

    <?php
    echo CHtml::ajaxSubmitButton(
            'Save', Yii::app()->createUrl('administrator/clients/create'), array(
        'type' => 'POST',
        'data' => 'js:$("#clients-form").serialize()',
        'success' => 'js:function(data){
            var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                {
                    $("#yw0").click();
                    $.fn.yiiGridView.update("all-clients");
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

