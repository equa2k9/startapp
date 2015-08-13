<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->clientScript->registerPackage('look') ?>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700' rel='stylesheet' type='text/css'>
        
    </head>
    <body>
        <?php $this->renderPartial('//site/_preheader') ?>
        <?php $this->renderPartial('//site/_header')?>

                <?php echo $content?>
          
        <?php $this->renderPartial('//site/_prefooter') ?>
        <?php $this->renderPartial('//site/_footer') ?>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    </body>
</html>
