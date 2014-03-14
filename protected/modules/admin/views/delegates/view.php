<?php
$this->breadcrumbs=array(
	'Delegates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Delegates','url'=>array('index')),
	array('label'=>'Create Delegates','url'=>array('create')),
	array('label'=>'Update Delegates','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Delegates','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Delegates','url'=>array('admin')),
);
?>

<h1>View Delegates #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'delegate_id',
		'level_id',
		'date_added',
	),
)); ?>
