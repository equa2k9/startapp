<script type="text/javascript">
    $.getJSON('<?php echo $this->createUrl("/administrator/articles/upload", array("_method" => "list", "id" => $model->id)); ?>', function (result) {
        var objForm = $('#articles-form');
        if (result && result.length) {
            objForm.fileupload('option', 'done').call(objForm, null, {result: result});
        }
    });
</script>
<?php
$this->widget('xupload.XUpload', array(
    'url' => Yii::app()->createUrl("/administrator/articles/upload"),
    //our XUploadForm
    'model' => $files,
    //We set this for the widget to be able to target our own form
    'htmlOptions' => array('id' => 'articles-form'),
    'attribute' => 'file',
    'multiple' => true,
        //Note that we are using a custom view for our widget
        //Thats becase the default widget includes the 'form'
        //which we don't want here
//                'formView' => 'application.views.somemodel._form',
        )
);
?>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'articles-form',
    'type' => 'vertical',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',)
        ));
?>


<?php
echo $form->dropDownListGroup(
        $model, 'category_id', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array(
        'data' => Categories::getCategories(),
        'htmlOptions' => array(),
    )
        )
);
?>
<div class="row">
    <div class="col-lg-4">
        <?php echo $form->textFieldGroup($model, 'name_uk', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->textFieldGroup($model, 'name_en', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->textFieldGroup($model, 'name_ru', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>

    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'description_uk', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'description_en', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'description_ru', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'specification_uk', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'specification_ru', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'specification_en', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'colors_uk', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'colors_ru', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'colors_en', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'sizes_uk', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'sizes_ru', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->html5EditorGroup($model, 'sizes_en', array('widgetOptions' => array('htmlOptions' => array('rows' => 6, 'cols' => 50, 'class' => 'span8')))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->textFieldGroup($model, 'alias_url', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5', 'maxlength' => 50)))); ?>
    </div>
    <div class="col-lg-4">
        <?php echo $form->textFieldGroup($model, 'price', array('widgetOptions' => array('htmlOptions' => array('class' => 'span5')))); ?>
    </div>
    <div class="col-lg-4">
        <?php
        echo $form->dropDownListGroup(
                $model, 'currency', array(
            'wrapperHtmlOptions' => array(
                'class' => 'col-sm-5',
            ),
            'widgetOptions' => array(
                'data' => Articles::$curr,
                'htmlOptions' => array(),
            )
                )
        );
        ?>
    </div>
</div>
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
