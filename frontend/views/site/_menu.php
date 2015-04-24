<?php

$this->widget('bootstrap.widgets.TbNavbar', array(
    'brand' => Yii::app()->name,
    'fixed' => true,
    'brandUrl' => '/',
    'collapse' => true, // requires bootstrap-responsive.css
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                array('label' => 'Contact', 'url' => array('/site/contact')),
            ), 'htmlOptions' => array(
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array('label' => 'Account', 'url' => '#',
                    'items' => array(
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'General info', 'url' => '/users/dashboard', 'visible' => !Yii::app()->user->isGuest,
                            'active' => Yii::app()->controller->action->id == "index" && Yii::app()->controller->id == "default"),
                        array('label' => 'Change password', 'url' => '/users/dashboard/changePassword', 'visible' => !Yii::app()->user->isGuest,
                            'active' => Yii::app()->controller->action->id == "changePassword"),
                        array('label' => 'Driver form', 'url' => '/users/dashboard/driverForm', 'visible' => !Yii::app()->user->isGuest &&
                            Yii::app()->user->role == 'user' ||
                            Yii::app()->user->role == "driver",
                            'active' => Yii::app()->controller->action->id == "driverForm"),
                        '---',
                        array('label' => 'Registration', 'url' => array('/site/registration'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                    )
                ),
            ), 'htmlOptions' => array(
                'class' => 'pull-right',
            ),
        ),
    ), 'htmlOptions' => array(
    ),
));
?>