<?php

$profilePhoto = file_exists(Yii::getPathOfAlias('uploads') . '/avatars/' . Users::current()->photo) ?
        Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/avatars/' . Users::current()->photo) :
        Yii::app()->assetManager->publish(Yii::getPathOfAlias('uploads') . '/avatars/avatar_blank.png');
$this->widget('bootstrap.widgets.TbNavbar', array(
    'brand' => Yii::app()->name,
    'fixed' => true,
    'type' => 'inverse',
    'brandUrl' => '/',
    'collapse' => true, // requires bootstrap-responsive.css
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array('label' => Yii::t('site', 'Home'), 'url' => array('/'), 'icon' => 'glyphicon glyphicon-home'),
                array('label' => Yii::t('site', 'Catalog'), 'url' => array('/catalog'), 'icon' => 'glyphicon glyphicon-list-alt', 'active' => Yii::app()->controller->id == "catalog"),
                array('label' => Yii::t('site', 'News'), 'url' => Yii::app()->createUrl('/news'), 'icon' => 'glyphicon glyphicon-list'),
                array('label' => Yii::t('site', 'Forum'), 'url' => array('/forum'), 'icon' => 'glyphicon glyphicon-globe'),
                array('label' => Yii::t('site', 'About us'), 'url' => array('/about'), 'icon' => 'glyphicon glyphicon-info-sign'),
                array('label' => Yii::t('site', 'Contact'), 'url' => array('/contact'), 'icon' => 'glyphicon glyphicon-envelope'),
                array('label' => 'Account', 'url' => '#', 'icon' => 'glyphicon glyphicon-user',
                    'items' => array(
                        array('label' => false, 'url' => false, 'itemOptions' => array('id' => 'user-avatar', 'class' => 'img-circle', 'style' => "background-image:url(" . $profilePhoto . ")"), 'visible' => !Yii::app()->user->isGuest),
                        '---',
                        array('label' => Yii::t('site', 'Login'), 'url' => array('/login'), 'visible' => Yii::app()->user->isGuest, 'icon' => 'glyphicon glyphicon-log-in'),
                        array('label' => Yii::t('site', 'General info'), 'url' => '/users/dashboard/index', 'visible' => !Yii::app()->user->isGuest,
                            'active' => Yii::app()->controller->action->id == "index" && Yii::app()->controller->id == "default", 'icon' => 'glyphicon glyphicon-pencil'),
                        array('label' => Yii::t('site', 'Change password'), 'url' => '/users/dashboard/changePassword', 'visible' => !Yii::app()->user->isGuest,
                            'active' => Yii::app()->controller->action->id == "changePassword", 'icon' => 'fa fa-key'),
                        array('label' => Yii::t('site', 'Registration'), 'url' => array('/registration'), 'visible' => Yii::app()->user->isGuest, 'icon' => 'glyphicon glyphicon-registration-mark'),
                        array('label' => Yii::t('site', 'Logout (' . Yii::app()->user->name . ')'), 'url' => array('/site/logout'), 'icon' => 'glyphicon glyphicon-log-out', 'visible' => !Yii::app()->user->isGuest),
                    )
                ),
            ), 'htmlOptions' => array(
                'class' => 'main_navigation',
                'class' => 'navbar-right',
            ),
        ),
    ), 'htmlOptions' => array(
//        'class'=>(Yii::app()->controller->id =='site'&&Yii::app()->controller->action->id=='index')?'navbar navbar-inverse hero':'navbar navbar-inverse',
//        'style'=>'margin-bottom:0!important;'
    ),
));

