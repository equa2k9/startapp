<?php

return array(
    /*
     * only frontend view, login, registering
     */
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
            'guest', // 
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'administrator',
        'children' => array(
            'user', // позволим админу всё, что позволено модератору
        ),
        'bizRule' => null,
        'data' => null,
    ),
);
