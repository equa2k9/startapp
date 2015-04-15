<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'guest',
        'bizRule' => null,
        'data' => null,
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'user',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'moderator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'moderator',
        'children' => array(
            'user', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'administrator',
        'children' => array(
            'moderator', // позволим админу всё, что позволено модератору
        ),
        'bizRule' => null,
        'data' => null,
    ),
);
