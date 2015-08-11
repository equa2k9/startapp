<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Categories','url'=>array('index')),
array('label'=>'Create Categories','url'=>array('create')),
array('label'=>'Update Categories','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Categories','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Categories','url'=>array('admin')),
);
?>

<h1>View Categories #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name_uk',
		'name_ru',
		'name_en',
		'alias_url',
		'picture',
		'sort',
),
)); ?>
