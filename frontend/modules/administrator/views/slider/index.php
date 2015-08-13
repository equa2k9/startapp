<div class="page-header">
    <h2>

        <?php echo Yii::t('site', 'Sliders') ?>
        <?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'label' => 'Add new slider',
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
    'id' => 'slider-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'responsiveTable' => true,
    'template' => "{items}",
    'filter' => $model,
    'columns' => array(
        'id0.name',
        array(
            'type' => 'html',
            'value' => 'Chtml::image("/images/slider/".$data->picture,"",array("style"=>"height:200px;"))'
        ),
        array(
            'class' => 'booster.widgets.TbButtonColumn',
            'template'=>'{update}{delete}'
        ),
    ),
));

?>