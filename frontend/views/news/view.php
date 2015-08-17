<?php $this->pageTitle = Yii::app()->name . " - " . $model->title ;
$this->breadcrumbs = array(Yii::t('site','News'),$model->title)?>

<!-- News Post Content Column -->
<img class="img-responsive" src=<?php echo "/images/news/$model->picture"?> alt="">
<div class="well">
    <hr>
    <header class="page-header">
        <h1 class="page-title"><?php echo $model->title ?></h1>
    </header>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo Yii::t('site','Created')?>:<?php echo date('d/m/Y H:i:s', $model->created_at) ?></p>
    <p class="text-justify"><?php echo $model->text ?></p>
</div>
