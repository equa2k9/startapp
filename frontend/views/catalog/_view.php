
<?php if ($itemView == 'list'):
    ?>
    <div class="single_item animated bounceInUp" style="-webkit-animation-delay: 0.<?php echo $index + 1 ?>s;">
        <div class="col-md-4 col-sm-5 remove-padding">
          <div class="item_image_list" style="background-image: url(/images/catalog/<?php echo isset($data->onePicture->picture) ? $data->onePicture->picture : '' ?>)"></div>
        </div>
        <div class="col-md-8 col-sm-7">
            <h3><?php echo $data->name ?></h3>
            <div class="row">
                <div class="col-xs-12">
                    <p><?php echo YText::characterLimiter($data->description, 400) ?></p>
                    <p class="lead"> <a href="<?php echo $data->getUrl() ?>" class="btn btn-primary"><?php echo Yii::t('site', 'Detail view') ?></a></p>
    <!--                    <ul class="list-inline"><li><?php // echo date('d/m/Y', $data->created_at)     ?></li></ul>-->
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php else: ?>
    <div class="col-sm-4 col-lg-4 col-md-4 animated bounceInUp" style="-webkit-animation-delay: 0.<?php echo $index + 1 ?>s;">
        <div class="single_item">
            <div class="item_image_square" style="background-image: url(/images/catalog/<?php echo isset($data->onePicture->picture) ? $data->onePicture->picture : '' ?>)"></div>
            <div class="caption caption-padding">
                <h3><a href="<?php echo $data->getUrl() ?>"><?php echo $data->name ?></a>
                </h3>
                <p><?php echo YText::characterLimiter($data->description, 200) ?></p>
                 <p class="lead"> <a href="<?php echo $data->getUrl() ?>" class="btn btn-primary"><?php echo Yii::t('site', 'Detail view') ?></a></p>
            </div>
        </div>
    </div>
<?php endif; ?>

