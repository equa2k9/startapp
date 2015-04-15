<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>
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
$this->widget(
        'booster.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Login')
);
?>
<?php $this->endWidget(); ?>

