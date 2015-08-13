<div class="page-header">
    <h2>

        <?php echo Yii::t('site', 'Products') ?>
        <?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => Yii::t('site', 'Add new'),
            'buttonType' => 'link',
            'url' => $this->createUrl('create'),
            'context' => 'info',
            'htmlOptions' => array(
                'class' => 'pull-right',
            ),
                )
        );
        ?>
    </h2>
</div>
<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'articles-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'responsiveTable' => true,
    'template' => "{items}",
    'filter' => $model,
    'columns' => array(
        'name_uk',
        'description_uk',
        'alias_url',
        array(
            'type' => 'html',
            'value' => 'Chtml::image("/images/catalog/".empty($data->onePicture) ?  "": $data->onePicture->picture,"",array("style"=>"height:100px;"))'
        ),
        array(
            'class' => 'booster.widgets.TbButtonColumn',
            'template'=>'{update}{view}{delete}'
        ),
    ),
));
?>
