<?php
$this->breadcrumbs = array(Yii::t('site', 'Catalog') => array('/catalog'), $model->category->name => array($model->category->getUrl()), $model->name);
$this->pageTitle = Yii::app()->name . " - " . $model->name;
Yii::app()->clientScript->registerPackage('colorCss');
?>
<!--PRODUCT WRAPPER-->
<div class="product_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-5">
                <div class="product_photos">
                    <div class="main_photo">
                        <a href="/images/catalog/<?php echo isset($model->onePicture->picture) ? $model->id.'/'.$model->onePicture->picture : 'no-photo.gif' ?>" alt="<?php $model->name?>" class="gallery">
                            <img src="/images/catalog/<?php echo isset($model->onePicture->picture) ? $model->id.'/'.$model->onePicture->picture : 'no-photo.gif' ?>" alt="<?php $model->name?>" alt="<?php echo $model->name ?>">
                        </a>
                    </div>
                    <?php if (count($model->articlesPictures) > 1): ?>
                        <?php $flag = false; ?>
                        <div class="photo_previews">
                            <?php foreach ($model->articlesPictures as $picture): ?>
                                <?php if ($flag): ?>
                                    <div class="one_preview">
                                        <a href="/images/catalog/<?php echo $model->id?>/<?php echo $picture->picture ?>" class="gallery">
                                            <img src="/images/catalog/<?php echo $model->id?>/<?php echo $picture->picture ?>" alt="<?php echo $model->name ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php $flag = true; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xs-7">
                <div>
                    <?php
                    $this->widget(
                            'zii.widgets.CBreadcrumbs', array(
                        'homeLink' => false,
                        'tagName' => 'ol',
                        'links' => $this->breadcrumbs,
                        'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                        'inactiveLinkTemplate' => '<li class="active">{label}</li>',
                        'separator' => false,
                        'htmlOptions' => array('class' => 'breadcrumb crumbs'),
                            )
                    );
                    ?>
                </div>
                <div class="product_info">
                    <h2><?php echo $model->name ?></h2>
                </div>
                <div class="price">
                    <p>
                        <span><?php echo $model->getCurrency()?></span>
                        <?php echo $model->price?>
                    </p>
                </div>
                <p class="product_description">
                    <?php echo $model->description ?>
                </p>
                <div class="product_details">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php if(!empty($model->colors)):?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" model-toggle="collapse" model-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo Yii::t('site','Avaible colors')?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?php echo $model->colors?>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if(!empty($model->sizes)):?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" model-toggle="collapse" model-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php echo Yii::t('site','Sizes')?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <?php echo $model->sizes?>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php if(!empty($model->specification)):?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" model-toggle="collapse" model-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                       <?php echo Yii::t('site','Specifications')?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php echo $model->specification?>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--PRODUCT WRAPPER-->
<?php Yii::app()->clientScript->registerPackage('colorJs'); ?>
<script>
    $(document).ready(function () {
        $('a.gallery').colorbox({rel: 'gal'});
    });
</script>