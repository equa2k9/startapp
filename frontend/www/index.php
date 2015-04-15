<?php

require __DIR__ . '/../../common/common.php';
# Setting up the frontend-specific aliases
Yii::setPathOfAlias('frontend', ROOT_DIR . '/frontend');
Yii::setPathOfAlias('www', ROOT_DIR . '/frontend/www');
# We use our custom-made WebApplication component as base class for frontend app.
require_once ROOT_DIR . '/frontend/components/FrontendWebApplication.php';
# For obvious reasons, backend entry point is constructed of specialised WebApplication and config
Yii::createApplication(
        'FrontendWebApplication', ROOT_DIR . '/frontend/config/main.php'
)->run();


