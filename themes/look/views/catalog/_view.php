
<?php // if ($itemView == 'list'):
    ?>
    <div class="one_product animated bounceInUp" style="-webkit-animation-delay: 0.<?php echo $index + 1 ?>s;">
        <a href="<?php echo $data->getUrl() ?>">
            <div class="img_wrap">
                <img  src="/images/catalog/<?php echo $data->id?>/<?php echo isset($data->onePicture->picture) ? $data->onePicture->picture : '' ?>" alt="<?php $data->name?>">
            </div>
            <h4><?php echo $data->name ?></h4>
            <p class="product_description">
                <?php echo YText::characterLimiter($data->description, ($itemView=='list')?200:40) ?>
            </p>
            <div class="price">
                <p>
                    <span><?php echo $data->getCurrency() ?></span>
                    <?php echo $data->price ?>
                </p>
            </div>
            <div class="view_btn_wrap">
                <button class="base_btn sm"><?php echo Yii::t('site', 'Detail view') ?></button>
            </div>
        </a>
    </div>



<?php // else: ?>
   
<?php // endif; ?>

