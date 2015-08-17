<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
        'sourcePath'=>ROOT_DIR, // eg. '/projects/myproject/protected'
        'messagePath'=>ROOT_DIR.'/console/messages', // '/projects/myproject/protected/messages'
        'languages'=>array('en','uk','ru'), // according to your translation needs
        'sourceLanguage' => 'en',
        'fileTypes'=>array('php'),
        'overwrite'=>false,
        'removeOld'=>true,
        'sort'=>true,
        'exclude'=>array(
                '.svn',
                '.gitignore',
                'yiilite.php',
                'yiit.php',
                '/i18n/data',
                '/messages',
                '/vendors',
                '/web/js',
                'UserModule.php', // if you are using yii-user ... 
        ),
);