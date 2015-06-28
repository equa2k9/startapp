<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Log in';
?>

<div class="row header">
    <div class="col-md-12">
        <h4><?php echo Yii::t('site','Log in to your account.')?></h4>
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
                                'label' => Yii::t('site','Sign in'),
//                                'htmlOptions' => array('class' => 'submit button-clear'),
                                    )
                            );
                            ?>
                        
                        <?php $this->endWidget(); ?>
                    </div>
                </div>						
            </div>
        </div>
        <div class="already-account">
            <?php echo Yii::t('site','Don\'t have an account?')?>
            <a href="<?php echo Yii::app()->createUrl('site/registration')?>"><?php echo Yii::t('site','Create one here')?></a>
        </div>
    </div>
</div>
