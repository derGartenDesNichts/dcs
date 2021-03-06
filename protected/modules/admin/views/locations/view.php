<?php
$this->breadcrumbs=array(
	'Locations'=>array('index'),
	$model->location_id,
);

$this->menu=array(
	array('label'=>'List Locations','url'=>array('index')),
	array('label'=>'Create Locations','url'=>array('create')),
	array('label'=>'Update Locations','url'=>array('update','id'=>$model->location_id)),
	array('label'=>'Delete Locations','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->location_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Locations','url'=>array('admin')),
);
?>

<h1>View Locations #<?php echo $model->location_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'location_id',
		'level_id',
		'place_id',
		'date_added',
	),
)); ?>
