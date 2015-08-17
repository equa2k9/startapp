<script type="text/javascript">
    function getimage()
    {
        var input = document.getElementById('picture_file');
        var fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function (event) {
            var img = document.getElementById('picture_news');
            img.src = event.target.result;
            $('#picture_news').show();
        }
    }

</script>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'news-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',)
        ));
?>




<?php echo $form->fileFieldGroup($model, 'picture', array('widgetOptions' => array('htmlOptions' => array('id' => 'picture_file', 'onchange' => 'getimage()')))); ?>
<?php if ($model->picture): ?><img id="picture_news" src="<?php echo YII::app()->baseUrl . '/images/news/' . $model->picture ?>" alt='' height='100px'><?php else: ?>
    <img id="picture_category" alt='' height="100px" style='display: none;'>
<?php endif; ?>

<?php echo $form->textFieldGroup($model, 'title_uk', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>






<?php echo $form->textFieldGroup($model, 'title_ru', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>

<?php echo $form->textFieldGroup($model, 'title_en', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>
<?php echo $form->html5EditorGroup($model, 'text_uk', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
<?php echo $form->html5EditorGroup($model, 'text_ru', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>

<?php echo $form->html5EditorGroup($model, 'text_en', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>

<?php echo $form->textFieldGroup($model, 'alias_url', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 255)))); ?>

<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
