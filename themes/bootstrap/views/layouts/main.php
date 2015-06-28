<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php Yii::app()->clientScript->registerPackage('custom') ?>
    </head>
    <body>
        <div id="wrap">
             <?php $this->widget('LanguageSwitcherWidget') ?>
            <!-- Navigation -->
            <?php $this->renderPartial('//site/_menu') ?>
            <?php $this->renderPartial('//site/_bread')?>


            <div class="container">
                <?php
                $this->widget('bootstrap.widgets.TbAlert', array(
                    'fade' => true, // use transitions?
                    'closeText' => '&times;', // close link text - if set to false, no close link is displayed
                    'alerts' => array(// configurations per alert type
                        'success' => array('block' => true, 'fade' => true, 'closeText' => '&times;'), // success, info, warning, error or danger
                        'error' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
                        'warning' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
                        'danger' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
                        'info' => array('block' => true, 'fade' => true, 'closeText' => '&times;'),
                    ),
                ));
                ?>
                <?php echo $content ?>
                
            </div>
            
        </div>
        
        <?php $this->renderPartial('//site/_footer') ?>
    </body>
</html>
