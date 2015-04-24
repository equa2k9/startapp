<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!--<link rel="stylesheet" href="<?php // echo Yii::app()->theme->baseUrl.'/'  ?>css/custom-style.css">-->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Navigation -->
        <?php $this->renderPartial('//site/_menu') ?>
        <div class="container-fluid main-container">
            <div class="col-md-2 sidebar">
                <?php $this->renderPartial('//site/_dashmenu') ?>
            </div>

            <div class="col-md-10 content">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Dashboard
                    </div>
                    <div class="panel-body">
                        <?php echo $content ?>
                    </div>
                </div>
            </div>

    </body>
</html>
