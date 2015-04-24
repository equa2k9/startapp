<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
?>


<div class="row">
    <!-- Article main content -->
    <div class="col-xs-12 maincontent">
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
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center"><?php echo Yii::t('site', 'Login') ?></h3>
                    <hr>
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

                    <div class="row">
                        <div class="col-lg-8">
                        </div>
                        <div class="col-lg-4 text-right">
                            <?php
                            $this->widget('booster.widgets.TbButton', array(
                                'buttonType' => 'submit',
                                'label' => 'Login',
                                'htmlOptions' => array('class' => 'btn btn-success btn-flat'),
                                    )
                            );
                            ?>
                        </div>
                        <br><br><br>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
