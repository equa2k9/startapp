<script type="text/javascript">
    $.getJSON('<?php echo $this->createUrl("dashboard/upload", array("_method" => "list", "id" => $model->id)); ?>', function (result) {
        var objForm = $('#drivers-info-form');
        if (result && result.length) {
            objForm.fileupload('option', 'done').call(objForm, null, {result: result});
        }
    });
</script>
<div class="page-header">
    <h2>Driver form<small>Here you can edit your driver form, to become driver</small></h2>
</div>

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
//    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
    ),
));
?>
<div class="col-md-12">
    <?php
    $this->widget('xupload.XUpload', array(
        'url' => Yii::app()->createUrl("users/dashboard/upload"),
        //our XUploadForm
        'model' => $files,
        //We set this for the widget to be able to target our own form
        'htmlOptions' => array('id' => 'drivers-info-form'),
        'attribute' => 'file',
        'multiple' => true,
            //Note that we are using a custom view for our widget
            //Thats becase the default widget includes the 'form'
            //which we don't want here
//                'formView' => 'application.views.somemodel._form',
            )
    );
    ?>
</div>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'drivers-info-form',
    'type' => 'vertical',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>


<div class="row text-primary">
    <div class="col-md-4">
        <?php echo $form->textFieldGroup($model->driversInfo, 'fullname', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?></div>
    <div class="col-md-4">
        <?php echo $form->textFieldGroup($model->driversInfo, 'address', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
    <div class="col-md-2">
        <?php echo $form->textFieldGroup($model->driversInfo, 'phone', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
    <div class="col-md-2">
        <?php echo $form->textFieldGroup($model->driversInfo, 'vehicle', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
</div>
<hr>
<div class="row text-warning">
    <div class="col-md-4">
        <?php echo $form->textFieldGroup($model->driversInfo, 'company', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>

    <div class="col-md-4">
        <?php echo $form->textFieldGroup($model->driversInfo, 'company_adress', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div> <div class="col-md-4">
        <?php echo $form->textFieldGroup($model->driversInfo, 'company_years', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
    </div>
</div>
<div class="row text-warning">
    <div class="col-md-12">
        <?php echo $form->textAreaGroup($model->driversInfo, 'work_history', array('widgetOptions' => array('htmlOptions' => array('rows' => 3, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
</div>
<hr>
<div class="row text-info">
    <div class="col-md-3">
        <?php echo $form->textFieldGroup($model->driversInfo, 'supervisor_name', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
    <div class="col-md-3">
        <?php echo $form->textFieldGroup($model->driversInfo, 'supervisor_contact', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
    <div class="col-md-3">
        <?php
        // echo $form->textFieldGroup($model->driversInfo,'worked_from',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); 
        echo $form->labelEx($model->driversInfo, 'worked_from');
        $this->widget(
                'booster.widgets.TbDatePicker', array(
            'model' => $model->driversInfo,
            'attribute' => 'worked_from',
//        'htmlOptions' => array('class'=>'col-md-4'),
                )
        );
        ?>
    </div>
    <div class="col-md-3">

        <?php
        // echo $form->textFieldGroup($model->driversInfo,'worked_to',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); 
        echo $form->labelEx($model->driversInfo, 'worked_to');
        $this->widget(
                'booster.widgets.TbDatePicker', array(
            'model' => $model->driversInfo,
            'attribute' => 'worked_to',
//        'htmlOptions' => array('class'=>'col-md-4'),
                )
        );
        echo $form->error($model->driversInfo, 'worked_to');
        ?>
    </div>
</div>
<div class="row text-danger">
    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model->driversInfo, 'leaving_reason', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model->driversInfo, 'position', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
    </div>
</div>

<hr>


<div class="row">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-4 text-right">
        <?php
        $this->widget('booster.widgets.TbButton', array(
            'buttonType' => 'submit',
            'context' => 'primary',
            'label' => $model->driversInfo->isNewRecord ? 'Create' : 'Save',
        ));
        ?>
    </div>
</div>
<br>

<?php $this->endWidget(); ?>
