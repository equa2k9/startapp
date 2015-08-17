<?php if($model):?>
<!--SLIDER-->
    <div class="slider_wrapper">
        <div class="container">
            <div class="row">
                <div id="products_carousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach($model as $key=>$slide):?>
                        
                        <li data-target="#products_carousel" data-slide-to="<?php echo $key?>" <?php echo ($key==0)?'class="active"':''?>></li>
                        <?php endforeach;?>
                    </ol>
                    
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach($model as $key=>$slide):?>
                        <div <?php echo ($key==0)?'class="item active"':'class="item"'?>>
                            <div class="row">
                                <div class="col-xs-3 columns slide_data">
                                    <h1><?php echo $slide->id0->name?></h1>
                                    <p class="description">
                                        <?php echo YText::characterLimiter($slide->id0->description, 100) ?>
                                    </p>
                                    <p class="price">price
                                        <span><?php echo $slide->id0->getCurrency()?></span>
                                        <?php echo $slide->id0->price?>
                                    </p>
                                    <a class="base_btn" href="<?php echo $slide->id0->getUrl()?>"><?php echo Yii::t('site','Detail view')?></a>
                                </div>
                                <div class="col-xs-9 columns text-right">
                                    <img src="/images/slider/<?php echo $slide->picture?>" alt="<?php echo $slide->id0->name?>" style="max-height:384px;">
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control prev_slide" href="#products_carousel" role="button" data-slide="prev"></a>
                    <a class="right carousel-control next_slide" href="#products_carousel" role="button" data-slide="next"></a>
                </div>
            </div>
        </div>
    </div>
    <!--SLIDER-->
    <?php endif;?>