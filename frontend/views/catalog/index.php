<?php $this->pageTitle = Yii::app()->name . " - " . Yii::t('site', 'Catalog'); ?>

<?php

$this->widget('frontend.components.ExtendedCListView', array(
    'id' => 'catalog-products',
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'ajaxUpdate' => true,
    'itemsCssClass' => (Yii::app()->session->get('view', 'list') == 'list') ? 'list' : 'row',
    'enablePagination' => false,
    'template' => "<div class='row filter-style remove-margin'><div class='pull-right'>{itemstyle}</div></div>\n\n{items}",
    'emptyCssClass'=>'col-md-12',
    'emptyTagName'=>'div',
    'cssFile' => false,
    'viewData' => array('itemView' => Yii::app()->session->get('view', 'list')),
));
