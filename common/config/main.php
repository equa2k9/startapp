<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('webroot.images.mail', ROOT_DIR . '/frontend/www/images/mail');
Yii::setPathOfAlias('users', ROOT_DIR . '/common/modules/users');
return array(
    'name' => 'Common application',
    // preloading 'log' component
    'preload' => array('log'),
    'sourceLanguage' => 'en',
    'language' => 'uk',
    // autoloading model and component classes
    'import' => array(
        'common.components.*',
        'common.components.actions.*',
        'common.controllers.*',
        'common.extensions.*',
//        'common.extensions.dynamictabularform.*',
        'common.models.*',
        'common.helpers.*',
        'common.extensions.YiiMailer.YiiMailer',
        'application.models.*',
        'application.components.actions.*',
        'application.components.*',
        'application.controllers.*',
        'application.extensions.*',
        'application.helpers.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        /**/
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '55555',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
        ),
        'assetManager' => array(
            'linkAssets' => false,
            'forceCopy'=>false,
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'session' => array(
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'sessions',
        ),
        'settings' => array(
            'class' => 'CmsSettings',
            'cacheComponentId' => 'cache',
            'cacheId' => 'global_website_settings',
            'cacheTime' => 84000,
            'tableName' => 'settings',
            'dbComponentId' => 'db',
            'createTable' => true,
            'dbEngine' => 'InnoDB',
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
        'curl' => array(
            'class' => 'common.extensions.curl.Curl',
            'options' => array(
                'timeout' => 1,
                'setOptions' => array(
                    CURLOPT_HEADER => false,
                ),
            ),
        ),
        'request' => array(
            'class' => 'DLanguageHttpRequest',
            'enableCookieValidation' => true,
//            'enableCsrfValidation' => true,
        ),
        'class' => 'DLanguageUrlManager',
        'urlManager' => array(
            'class' => 'DLanguageUrlManager',
            'urlFormat' => 'path',
//            'useStrictParsing' => true,
            'showScriptName' => false,
            'rules' => array(
                '' => 'site/index',
                '<action:(contact|login|logout|registration|about|delivery)>' => 'site/<action>',
                '<controller:(news)>/<alias_url>' => 'news/view',
                '<controller:(catalog)>/<alias_url>/<alias>' => '<controller>/view',
                '<controller:(catalog)>/<alias_url>' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        // this is used in contact page
        'uploads' => Yii::getPathOfAlias('uploads'),
        'translatedLanguages' => array(
            'uk' => 'Українська',
            'ru' => 'Русский',
            'en' => 'English',
        ),
        'defaultLanguage' => 'uk',
    ),
);
