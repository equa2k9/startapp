
<div class="page-header">
    <h2>

        <?php echo Yii::t('site', 'News') ?>
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
    'id' => 'news-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'title_uk',
        'text_uk',
        'created_at',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
            'template'=>'{update}{delete}'
        ),
    ),
));

