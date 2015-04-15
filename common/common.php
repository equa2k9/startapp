<?php
# This is the global common file containing code which should be run for *every* entry point.
# Path to the real root of project
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
define('ROOT_DIR', realpath(__DIR__ . '/../'));

# If master ordered us to work in production mode, remember it.

# BEFORE loading the framework or it will have no effect on Yii!
# Launching the Yii framework.
require_once ROOT_DIR . '/common/lib/yii/framework/YiiBase.php';
# Include our own Yii singleton definition
require_once ROOT_DIR . '/common/components/Yii.php';
# Include our own base WebApplication class
require_once ROOT_DIR . '/common/components/WebApplication.php';
# Some global aliases
Yii::setPathOfAlias('root', ROOT_DIR);
Yii::setPathOfAlias('common', ROOT_DIR . '/common');
Yii::setPathOfAlias('vendor', ROOT_DIR . '/vendor');
# Global timezone setting

# PWD will be the root dir of the project
chdir(ROOT_DIR);