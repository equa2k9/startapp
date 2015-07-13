<?php $this->pageTitle = Yii::app()->name . " - " . Yii::t('site', 'Catalog'); ?>
<h3 class="catalog_heading"><?php echo $this->headerTitle?></h3>
<?php
$this->widget('frontend.components.ExtendedCListView', array(
    'id' => 'catalog-products',
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'ajaxUpdate' => true,
    'afterAjaxUpdate'=>'js:function(){useMasonry()}',
    'itemsCssClass' => (Yii::app()->session->get('view', 'list') == 'list') ? 'products_list full_width_cards clearfix test' : 'products_list clearfix test',
    'enablePagination' => true,
    'template' => "<div class='crumbs_wrapper'><ol class='breadcrumb crumbs'>
                        <li><a href='#'>Головна</a></li>
                        <li class='active'>Каталог</li>
                    </ol>"
    . "<div class='product_grid_switcher'>{itemstyle}</div></div>\n{items}\n<nav class='products_pagination'>{pager}</nav>",
    'emptyCssClass' => 'col-md-12',
    'emptyTagName' => 'div',
    'enableSorting'=>false,
    'cssFile' => false,
    'pagerCssClass'=>'',
    'sorterCssClass'=>'',
    'pager'=>array('header'=>false,'cssFile'=>false,'htmlOptions'=>array('class'=>'pagination')),
    'viewData' => array('itemView' => Yii::app()->session->get('view', 'list')),
    'enableHistory'=>true,
));
?>
<?php Yii::app()->clientScript->registerPackage('imagesLoaded');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>

<script>
     function useMasonry()
     {
         var freeMasonry =[];
         freeMasonry = $('.test');
          freeMasonry.imagesLoaded()
            .done(function () {
                freeMasonry.masonry({
                    itemSelector: '.item'
                });
            });
    }
    useMasonry();
</script>

