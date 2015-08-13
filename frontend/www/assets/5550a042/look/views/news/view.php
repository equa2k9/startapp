<?php
$this->pageTitle = Yii::app()->name . " - " . $model->title;
$this->breadcrumbs = array(Yii::t('site', 'News'), $model->title)
?>
<div class="catalog">
    <div class="container">
        <div class="one-news">
            <!-- News Post Content Column -->
            <img class="img-responsive" src=<?php echo "/images/news/$model->picture" ?> alt="">

            <header class="page-header">
                <h1 class="page-title"><?php echo $model->title ?></h1>
            </header>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo Yii::t('site', 'Created') ?>:<?php echo date('d/m/Y H:i:s', $model->created_at) ?></p>
            <p class="text-justify"><?php echo $model->text ?></p>
        </div>
    </div>
</div>