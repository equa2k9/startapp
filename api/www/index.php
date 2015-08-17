<?php

require __DIR__ . '/../../common/common.php';
# Setting up the frontend-specific aliases
Yii::setPathOfAlias('api', ROOT_DIR . '/api');
Yii::setPathOfAlias('www', ROOT_DIR . '/api/www');
# We use our custom-made WebApplication component as base class for frontend app.
require_once ROOT_DIR . '/api/components/ApiWebApplication.php';
# For obvious reasons, backend entry point is constructed of specialised WebApplication and config
Yii::createApplication(
        'ApiWebApplication', ROOT_DIR . '/api/config/main.php'
)->run();


