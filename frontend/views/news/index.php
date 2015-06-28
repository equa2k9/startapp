<?php $this->pageTitle = Yii::app()->name." - ".Yii::t('site','News') ?>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'enablePagination' => false,
    'template' => "{sorter}\n{items}\n{pager}",
    'emptyText' => '',
));
?>
</div>
