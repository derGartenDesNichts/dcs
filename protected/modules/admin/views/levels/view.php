<?php
$this->breadcrumbs=array(
	'Levels'=>array('index'),
	$model->level_id,
);

$this->menu=array(
	array('label'=>'List Levels','url'=>array('index')),
	array('label'=>'Create Levels','url'=>array('create')),
	array('label'=>'Update Levels','url'=>array('update','id'=>$model->level_id)),
	array('label'=>'Delete Levels','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->level_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Levels','url'=>array('admin')),
);
?>

<h1>View Levels #<?php echo $model->level_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'level_id',
		'parent_id',
		'description',
		'date_added',
	),
)); ?>
