<?php
$this->beginWidget(
        'booster.widgets.TbModal', array('id' => 'create-passenger')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add new passenger</h4>
</div>

<div class="modal-body">
    <?php
    $form = $this->beginWidget(
            'booster.widgets.TbActiveForm', array(
        'id' => 'passenger-form',
        'action' => Yii::app()->createUrl('administrator/clients/createPassenger'),
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well', 'validateOnSubmit' => false), // for insert effect
            )
    );
    ?>
    <div class="row">
        <?php
        echo $form->hiddenField($model, 'clients_id', array('value' => $id));
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'name') ?>

    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'phone') ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'email') ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'pickup_number') ?>
    </div>
    <div class="row">
        <?php echo $form->textFieldGroup($model, 'dropoff_number') ?>
    </div>
</div>

<div class="modal-footer">

    <?php
    echo CHtml::ajaxSubmitButton(
            'Save', Yii::app()->createUrl('administrator/clients/createPassenger'), array(
        'type' => 'POST',
        'data' => 'js:$("#passenger-form").serialize()',
        'success' => 'js:function(data){
            var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                {
                    $("#yw1").click();
                    $.fn.yiiGridView.update("all-passengers");
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

