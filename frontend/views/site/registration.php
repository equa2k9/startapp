<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Log in';
?>

<div class="row header">
    <div class="col-md-12">
        <h4><?php echo Yii::t('site', 'Register new account') ?></h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="wrapper clearfix">
            <div class="formy">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $this->widget('booster.widgets.TbAlert', array(
//            'block' => true, // display a larger alert block?
                            'fade' => true, // use transitions?
                            'closeText' => '&times;', // close link text - if set to false, no close link is displayed
                            'alerts' => array(// configurations per alert type
                                'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;')// success, info, warning, error or danger
                            ),
                        ));
                        ?>

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
                    </div>
                </div>						
            </div>
        </div>
        <div class="already-account">
            <?php echo Yii::t('site', 'Already have an account?') ?>
            <a href="<?php echo Yii::app()->createUrl('site/login') ?>"><?php echo Yii::t('site', 'Log in here') ?></a>
        </div>
    </div>
</div>
</div>