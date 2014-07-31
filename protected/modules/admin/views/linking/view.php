<?php
$this->breadcrumbs=array(
	'Linkings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Linking','url'=>array('index')),
	array('label'=>'Create Linking','url'=>array('create')),
	array('label'=>'Update Linking','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Linking','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Linking','url'=>array('admin')),
);
?>

<h1>View Linking #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'level_id',
		'location_id',
	),
)); ?>
