<?php if ($model): ?>
    <!--POPULAR PRODUCTS-->
    <div class="popular_products_wrap">
        <div class="container">
            <div class="row">
                <h4><?php echo Yii::t('site', 'Popular products') ?></h4>
            </div>
            <div class="row">
                <div class="popular_products clearfix">
                    <?php foreach ($model as $product): ?>
                        <div class="one_product">
                            <a href="<?php echo $product->getUrl() ?>">
                                <div class="img_wrap">
                                    <img src="/images/catalog/<?php echo isset($model->onePicture->picture) ? $model->id.'/'.$model->onePicture->picture : 'no-photo.gif' ?>" alt="<?php echo $product->name ?>" >
                                </div>
                                <h4><?php echo $product->name ?></h4>
                                <p class="product_description">
                                    <?php echo YText::characterLimiter($product->description, 40) ?>
                                </p>

                                <div class="price">
                                    <p>
                                        <span><?php echo $product->getCurrency() ?></span>
                                        <?php echo $product->price ?>
                                    </p>
                                </div>
                                <div class="view_btn_wrap">
                                    <button class="base_btn sm"><?php echo Yii::t('site', 'Detail view') ?></button>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!--POPULAR PRODUCTS-->
<?php endif; ?>