

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
                    <h3 class="thin text-center"><?php echo Yii::t('site', 'Input your data') ?></h3>
                    <hr>
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
                    <div class="top-margin">
                        <?php echo $form->textFieldGroup($model, 'username', array('class' => 'form-control')); ?>
                    </div>
                    <div class="top-margin">
                        <?php echo $form->textFieldGroup($model, 'email', array('class' => 'form-control')); ?>
                    </div>
                    <div class="top-margin">
                        <?php echo $form->fileFieldGroup($model, 'image', array('class' => 'form-control')); ?>
                    </div>
                    <div class="row top-margin">
                        <div class="col-sm-6">
                            <?php echo $form->passwordFieldGroup($model, 'userPassword', array('class' => 'form-control')); ?>
                        </div>
                        <div class="col-sm-6">
                            <?php echo $form->passwordFieldGroup($model, 'userPasswordRe', array('class' => 'form-control')); ?>
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
                                'label' => Yii::t('site', 'Registration'),
                                'htmlOptions' => array('class' => 'btn btn-success btn-flat'),
                            ));
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

