<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<h1>Contact Us</h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>
    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
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
        'id' => 'contact-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <?php echo $form->textFieldGroup($model, 'name'); ?>
    <?php echo $form->textFieldGroup($model, 'email'); ?>
    <?php echo $form->textFieldGroup($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
    <?php echo $form->textAreaGroup($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
    <?php if (CCaptcha::checkRequirements()): ?>

        <div>
            <?php $this->widget('CCaptcha'); ?>
            <?php
            echo $form->textFieldGroup($model, 'verifyCode', array(
                'widgetOptions' => array(
                ),
                'hint' => 'Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.',
            ));
            ?>
        </div>
    <?php endif; ?>
    <?php
    $this->widget(
            'booster.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'submit')
    );
    ?>
    <?php $this->endWidget(); ?>
<?php endif; ?>