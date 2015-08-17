<!--ABOUT_US-->
<div class="about_us">
    <div class="container">
        <h3 class="catalog_heading"><?php echo Yii::t('site','About us')?></h3>
        <p>
            <?php Yii::app()->settings->get('admin','about_'.Yii::app()->language)?>
        </p>
    </div>
</div>
<!--ABOUT_US-->