<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => 'console',
    'name' => 'Console app',
    'commandMap' => array(
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationPath' => 'application.migrations',
//            'templateFile' => 'common.migrations.template.template'
        ),
        'message'=>array(
             'class' => 'system.cli.commands.MessageCommand'
        )
    ),
);
