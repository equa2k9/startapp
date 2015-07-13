<?php if($model):?>
<!--CATEGORIES-->
    <div class="common_categories">
        <div class="container">
            <div class="row">
                <?php foreach($model as $category):?>
                <div class="one_categoty_wrapper col-xs-2 columns">
                    <a href="<?php echo $category->getUrl()?>">
                        <div class="one_category">
                            <div class="category_hover">
                                <p class="text-center"><?php echo $category->name?></p>
                            </div>
                            <img src="/images/categories/<?php echo $category->picture?>" alt="<?php echo $category->name?>">
                        </div>
                    </a>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <!--CATEGORIES-->
    <?php endif;?>

