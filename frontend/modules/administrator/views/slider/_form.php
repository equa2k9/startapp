<script type="text/javascript">
    function getimage()
    {


        var input = document.getElementById('picture_file');
        var fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function (event) {
            var img = document.getElementById('picture_category');
            img.src = event.target.result;
            $('#picture_category').show();
        }
    }

</script>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'slider-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',)
        ));
?>

<?php
echo $form->dropDownListGroup(
        $model, 'id', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => array(Slider::getArticlesToSlider()),
        'htmlOptions' => array(),
    )
        )
);
?>
<?php echo $form->fileFieldGroup($model, 'picture', array('widgetOptions' => array('htmlOptions' => array('id' => 'picture_file', 'onchange' => 'getimage()')))); ?>


<?php if ($model->picture): ?><img id="picture_category" src="<?php echo YII::app()->baseUrl . '/images/slider/' . $model->picture ?>" alt='' height='100px'><?php else: ?>
    <img id="picture_category" alt='' height="100px" style='display: none;'>
<?php endif; ?>

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
