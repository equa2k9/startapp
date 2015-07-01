<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - '.Yii::t('site','Registration');
$this->breadcrumbs = array(Yii::t('site','Registration'));
?>
<div class="col-md-8 col-md-offset-2 well">
<div class="page-header">
        <h2><?php echo Yii::t('site', 'Register new account') ?></h2>
</div>


                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'user-registration-form',
                            'type' => 'vertical',
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                        ));
                        ?>

                        <?php echo $form->textFieldGroup($model, 'username', array('class' => 'form-control')); ?>

                        <?php echo $form->textFieldGroup($model, 'email', array('class' => 'form-control')); ?>


                        <?php echo $form->fileFieldGroup($model, 'image', array('class' => 'form-control')); ?>


                        <?php echo $form->passwordFieldGroup($model, 'userPassword', array('class' => 'form-control')); ?>

                        <?php echo $form->passwordFieldGroup($model, 'userPasswordRe', array('class' => 'form-control')); ?>

                        <?php
                        $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType' => 'submit',
                            'label' => Yii::t('site', 'Create my account'),
                            'htmlOptions' => array('class' => 'btn btn-success btn-flat'),
                        ));
                        ?>

                        <?php $this->endWidget(); ?>
            
        <div class="already-account">
            <?php echo Yii::t('site', 'Already have an account?') ?>
            <a href="<?php echo Yii::app()->createUrl('site/login') ?>"><?php echo Yii::t('site', 'Log in here') ?></a>
        </div>
  </div>