<h1>View Articles #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'category_id',
		'name_uk',
		'name_ru',
		'name_en',
		'description_uk',
		'description_en',
		'description_ru',
		'alias_url',
		'sort',
		'price',
		'currency',
),
)); ?>
