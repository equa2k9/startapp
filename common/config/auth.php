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
    /*
     * Reader only
     */
    'admin_reader' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'admin_reader',
        'children' => array(
            'user', // 
        ),
        'bizRule' => null,
        'data' => null,
    ),
    /*
     * Can accept routesheets, change self info, leave comments etc.
     */
    'driver' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'driver',
        'children' => array(
            'admin_reader',
        ),
        'bizRule' => null,
        'data' => null,
    ),
    /*
     * 
     */
    'accountant' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'accountant',
        'children' => array(
            'driver', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'dispatcher' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'dispatcher',
        'children' => array(
            'accountant', // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null,
    ),
    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'administrator',
        'children' => array(
            'dispatcher', // позволим админу всё, что позволено модератору
        ),
        'bizRule' => null,
        'data' => null,
    ),
);
