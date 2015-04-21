<?php
Yii::setPathOfAlias('bootstrap', Yii::getPathOfAlias('common'). '/extensions/yiibooster');
Yii::setPathOfAlias('editable', Yii::getPathOfAlias('common'). '/extensions/x-editable');
return array(
    'basePath' => 'frontend',
    'name' => 'Frontend',
    'theme'=>'bootstrap', //not use booster core css, because it's old 3.1.1 version
    'preload' => array('bootstrap'),
    'aliases' => array(
        'xupload' => 'common.extensions.xupload',
        'yiiwheels' =>  Yii::getPathOfAlias('common'). '/extensions/yiiwheels', // change if necessary
        
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        /**/
        'users'=>array(
            'class'=>'frontend.modules.users.UsersModule',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'components' => array(
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'phpThumb' => array(
            'class' => 'common.ext.EPhpThumb.EPhpThumb',
            'options' => array(),
        ),
        'editable' => array(
            'class' => 'editable.EditableConfig',
            'form' => 'bootstrap', //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode' => 'popup', //mode: 'popup' or 'inline'
            'defaults' => array(//default settings for all editable elements
                'emptytext' => Yii::t('site','Click to edit'),
            ),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Booster',
            'responsiveCss' => true,
            'minify' => true,
            'coreCss' => true,
        ),
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',
        ),
        'themeManager'=>array(
            'basePath'=>ROOT_DIR.'/themes',
        ),
        
        
    ),
    
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'ololo@gmail.com',
    ),
);
