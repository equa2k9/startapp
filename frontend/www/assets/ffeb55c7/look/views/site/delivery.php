<!--DELIVERY-->
<div class="delivery">
    <div class="container">
        <div class="delivery_block">
            <h3 class="catalog_heading"><?php echo Yii::t('site','Delivery within relative proximity')?></h3>
            <p>
                <?php echo Yii::app()->settings->get('admin','delivery1_'.Yii::app()->language)?>
            </p>
           
        </div>
        <div class="delivery_block">
            <h3 class="catalog_heading"><?php echo Yii::t('site','Delivery in Ukraine')?></h3>
            <p>
               <?php echo Yii::app()->settings->get('admin','delivery2_'.Yii::app()->language)?>
            </p>
        </div>
    </div>
</div>
<!--DELIVERY-->
