<?php
$this->breadcrumbs=array(
	'Sliders'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Slider','url'=>array('index')),
array('label'=>'Manage Slider','url'=>array('admin')),
);
?>

<h1>Create Slider</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>