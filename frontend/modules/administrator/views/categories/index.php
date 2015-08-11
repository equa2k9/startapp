<div class="page-header">
    <h2>

        <?php echo Yii::t('site', 'Categories') ?>
        <?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => 'Add new category',
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
    'id' => 'categories-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'responsiveTable' => true,
    'template' => "{items}",
    'filter' => $model,
    'columns' => array(
//        'id',
        'name_uk',
        'name_ru',
        'name_en',
        'alias_url',
        array(
            'type' => 'html',
            'value' => 'Chtml::image("/images/categories/".$data->picture,"",array("style"=>"height:100px;"))'
        ),
        /*
          'sort',
         */
        array(
            'class' => 'booster.widgets.TbButtonColumn',
            'template'=>'{update}{delete}'
        ),
    ),
));
?>
