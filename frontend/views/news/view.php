<?php $this->pageTitle = Yii::app()->name . " - " . $model->title ?>

<!-- News Post Content Column -->
<div class="col-md-12 well">
    <header class="page-header">
        <h1 class="page-title"><?php echo $model->title ?></h1>
    </header>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo Yii::t('site','Created')?>:<?php echo date('d/m/Y H:i:s', $model->created_at) ?></p>

    <hr>

    <img class="img-responsive" src="<?php echo Yii::app()->createUrl("images/news/$model->picture") ?>" alt="">

    <hr>


    <p class="text-justify"><?php echo $model->text ?></p>
</div>
