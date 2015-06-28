<div class="col-md-12 col-xs-12 well">
    <div class="col-md-2 col-sm-3 text-center">
        <a class="story-img" href="#"><img src="<?php echo Yii::app()->createUrl("images/news/$data->picture") ?>" style="width:150px;height:150px" class="img-circle"></a>
    </div>
    <div class="col-md-10 col-sm-9">
        <h3><?php echo $data->title ?></h3>
        <div class="row">
            <div class="col-xs-12">
                <p><?php echo YText::characterLimiter($data->text, 400) ?></p>
                <p class="lead"> <a href="<?php echo Yii::app()->createUrl("news/$data->id") ?>" class="btn btn-primary"><?php echo Yii::t('site', 'Detail view') ?></a></p>
                <ul class="list-inline"><li><?php echo date('d/m/Y', $data->created_at) ?></li></ul>
            </div>
            <div class="col-xs-3"></div>
        </div>
        <hr>
    </div>
</div>



