<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'delivery-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',)
        ));
?>





<?php echo $form->textAreaGroup($delivery, 'delivery1_uk', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

<?php echo $form->textAreaGroup($delivery, 'delivery1_ru', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

<?php echo $form->textAreaGroup($delivery, 'delivery1_en', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

<?php echo $form->textAreaGroup($delivery, 'delivery2_uk', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

<?php echo $form->textAreaGroup($delivery, 'delivery2_ru', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

    <?php echo $form->textAreaGroup($delivery, 'delivery2_en', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => Yii::t('site','Save'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>