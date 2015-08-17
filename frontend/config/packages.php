<?php

return
        array(
//            'coreScriptPosition' => CClientScript::POS_HEAD,
            'packages' => array(
                //====================libs=======================
                'custom' => array(
                    'basePath' => 'themes',
                    'css' => array('bootstrap/css/bootstrap.css','bootstrap/css/custom.css','bootstrap/css/custom-styles.css','bootstrap/css/flag-icon.css','bootstrap/css/animate.min.css'),
//                    'js'=>array('react/js/theme.js')
                ),
                'look' => array(
                    'basePath' => 'themes',
                    'css' => array('look/css/bootstrap.min.css','look/css/bootstrap-theme.min.css','look/css/custom_styles.css','bootstrap/css/flag-icon.css','bootstrap/css/animate.min.css','look/css/new-styles.css'),
//                    'js'=>array('react/js/theme.js')
                ),
                'colorCss'=>array(
                    'basePath' => 'themes',
                    'css'=>array('look/css/colorbox.css'),
                ),
                'colorJs'=>array(
                    'basePath' => 'themes',
                    'js'=>array('look/js/jquery.colorbox-min.js'),
                ),
                'imagesLoaded'=>array(
                    'basePath' => 'themes',
                    'js'=>array('look/js/imagesloaded.pkgd.min.js'),
                ),
                'sb-admin-css'=>array(
                    'basePath' => 'themes',
                    'css'=>array(
                        'sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css',
                        'sb-admin/bower_components/metisMenu/dist/metisMenu.min.css',
                        'sb-admin/dist/css/timeline.css',
                        'sb-admin/dist/css/sb-admin-2.css',
                        
                        'sb-admin/bower_components/font-awesome/css/font-awesome.min.css'
                    ),
                    
                ),
                'sb-admin-js'=>array(
                        'basePath' => 'themes',
                        'js'=>array(
                            'sb-admin/bower_components/metisMenu/dist/metisMenu.min.js',
                            'sb-admin/bower_components/raphael/raphael-min.js',
                            
                            
                            'sb-admin/dist/js/sb-admin-2.js'
                        )
                    ),
               
               
            )
);
