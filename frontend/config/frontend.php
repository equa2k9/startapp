<?php

Yii::setPathOfAlias('bootstrap', Yii::getPathOfAlias('common') . '/extensions/yiibooster');
Yii::setPathOfAlias('editable', Yii::getPathOfAlias('common') . '/extensions/x-editable');
return array(
    'basePath' => 'frontend',
    'name' => 'JAZZ-ACOUSTICS',
    'theme' => 'bootstrap', //not use booster core css, because it's old 3.1.1 version
    //now it's replaced in this extension with new styled version
    'sourceLanguage' => 'en',
    'language' => 'en',
    'preload' => array('bootstrap'),
    'aliases' => array(
        'xupload' => 'common.extensions.xupload',
        'yiiwheels' =>  Yii::getPathOfAlias('common'). '/extensions/yiiwheels', // change if necessary
    ),
    'modules' => array(
        'users' => array(
            'class' => 'frontend.modules.users.UsersModule',
        ),
        'administrator' => array(
            'class' => 'frontend.modules.administrator.AdministratorModule',
        ),
    ),
    'components' => array(
//        'request' => array('class' => 'EHttpRequest',),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
//        'phpThumb' => array(
//            'class' => 'common.ext.EPhpThumb.EPhpThumb',
//            'options' => array(),
//        ),
        'editable' => array(
            'class' => 'editable.EditableConfig',
            'form' => 'bootstrap', //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode' => 'popup', //mode: 'popup' or 'inline'
            'defaults' => array(//default settings for all editable elements
                'emptytext' => Yii::t('site', 'Click to edit'),
            ),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Booster',
            'enableCdn' => false,
            'responsiveCss' => true,
            'minify' => true,
            'coreCss' => false,
        ),
        
//        'yiiwheels' => array(
//            'class' => 'yiiwheels.YiiWheels',
//        ),
        'themeManager' => array(
            'basePath' => ROOT_DIR . '/themes',
        ),
        'clientScript' => require (dirname(__FILE__).'/packages.php'),
    ),
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'ololo@gmail.com',
        
    ),
);
