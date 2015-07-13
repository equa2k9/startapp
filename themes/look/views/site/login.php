<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - '.Yii::t('site','Log in');
$this->breadcrumbs = array(Yii::t('site','Log in'));
?>

<div class="col-md-8 col-md-offset-2 well">

    <div class="row">
        <div class="col-md-6">
            <div class="page-header">
                <h2><?php echo Yii::t('site', 'Log in to your account.') ?></h2>
            </div>
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'login-form',
                'type' => 'vertical',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>
            <?php echo $form->textFieldGroup($model, 'username'); ?>
            <?php echo $form->passwordFieldGroup($model, 'password'); ?>
            <?php echo $form->checkBoxGroup($model, 'rememberMe'); ?>


            <?php
            $this->widget('booster.widgets.TbButton', array(
                'buttonType' => 'submit',
                'label' => Yii::t('site', 'Sign in'),
//                                'htmlOptions' => array('class' => 'submit button-clear'),
                    )
            );
            ?>

            <?php $this->endWidget(); ?>

            <div class="already-account">
                <?php echo Yii::t('site', 'Don\'t have an account?') ?>
                <a href="<?php echo Yii::app()->createUrl('site/registration') ?>"><?php echo Yii::t('site', 'Create one here') ?></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="page-header">
                <h2><?php echo Yii::t('site', 'Login via social networks') ?></h2>
            </div>

        </div>
    </div>
</div>