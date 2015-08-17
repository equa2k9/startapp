<?php
$this->pageTitle = Yii::app()->name . " - " . Yii::t('site', 'News');
$this->breadcrumbs = array(Yii::t('site', 'News'))
?>

<div class="catalog">
    <div class="container">
        
            <h3 class="catalog_heading"><?php echo Yii::t('site', 'News')?></h3>
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
                'itemsCssClass' => 'products_list full_width_cards clearfix',
                'enablePagination' => false,
                'template' => "{sorter}\n{items}\n{pager}",
                'emptyText' => '',
            ));
            ?>
        
    </div>
</div>

