
<div class="one_product animated bounceInUp" style="-webkit-animation-delay: 0.<?php echo $index + 1 ?>s;">
    <a href="<?php echo $data->getUrl()?>">
        <div class="img_wrap">
            <img src="<?php echo "/images/news/$data->picture" ?>" alt="<?php echo $data->title ?>">
        </div>
        <h4><?php echo $data->title ?></h4>
        <p class="product_description">
            <?php echo YText::characterLimiter($data->text, 400) ?>
        </p>


        <div class="view_btn_wrap">
            <button class="base_btn sm"><?php echo Yii::t('site', 'Detail view') ?></button>
        </div>
    </a>
</div>



