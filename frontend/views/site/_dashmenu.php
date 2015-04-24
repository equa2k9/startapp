<?php

$this->widget(
        'booster.widgets.TbPanel', array(
    'title' => 'Menu',
    'headerIcon' => 'list',
    'padContent' => false,
    'content' => $this->widget(
            'booster.widgets.TbMenu', array(
        'type' => 'list',
        'activateParents' => true,
        'items' => $this->menu,
            ), true),
        )
);
