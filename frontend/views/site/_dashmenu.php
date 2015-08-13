<?php

$this->widget(
        'booster.widgets.TbPanel', array(
    'title' => Yii::t('site','Catalog'),
    'headerIcon' => 'glyphicon glyphicon-list-alt',
    'context' => 'primary',
    'padContent' => false,
    'content' => $this->widget(
            'booster.widgets.TbMenu', array(
        'type' => 'list',
        'activateParents' => true,
        'items' => Categories::getCategoriesMenu(),
            ), true),
        )
);
