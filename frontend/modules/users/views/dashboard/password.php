<div class="page-header">
    <h2>Change password <small>Here you can change your password</small></h2>
</div>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'password-change-form',
    'type' => 'vertical',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="row">
    <div class="col-sm-6">
        <?php echo $form->passwordFieldGroup($password, 'oldPassword', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-6">

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $form->passwordFieldGroup($password, 'userPassword', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $form->passwordFieldGroup($password, 'userPasswordRe', array('class' => 'form-control')); ?>
    </div>
</div>


<hr>
<div class="row">
    <div class="col-lg-8">
    </div>
    <div class="col-lg-4 text-right">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'label' => Yii::t('site', 'Change'),
            'htmlOptions' => array('class' => 'btn btn-success btn-flat'),
        ));
        ?>
    </div>
    <br><br><br>
</div>
<?php $this->endWidget(); ?>
 

