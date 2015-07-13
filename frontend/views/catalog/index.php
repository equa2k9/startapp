<?php $this->pageTitle = Yii::app()->name . " - " . Yii::t('site', 'Catalog'); ?>

<?php
$this->widget('frontend.components.ExtendedCListView', array(
    'id' => 'catalog-products',
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'ajaxUpdate' => true,
    'afterAjaxUpdate'=>'js:function(){useMasonry()}',
    'itemsCssClass' => (Yii::app()->session->get('view', 'list') == 'list') ? 'test' : 'row test',
    'enablePagination' => false,
    'template' => "<div class='row filter-style remove-margin'><div class='pull-right'>{itemstyle}</div></div>\n\n{items}",
    'emptyCssClass' => 'col-md-12',
    'emptyTagName' => 'div',
    'cssFile' => false,
    'viewData' => array('itemView' => Yii::app()->session->get('view', 'list')),
));
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>
<script>
     function useMasonry()
     {
         var freeMasonry =[];
         freeMasonry = $('.test');
                    freeMasonry.masonry({
                        itemSelector: '.item'
                    });
    }
    useMasonry();
</script>
