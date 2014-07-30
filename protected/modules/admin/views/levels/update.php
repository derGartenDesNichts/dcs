<?php
$this->breadcrumbs=array(
	'Levels'=>array('index'),
	$model->level_id=>array('view','id'=>$model->level_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Levels','url'=>array('index')),
	array('label'=>'Create Levels','url'=>array('create')),
	array('label'=>'View Levels','url'=>array('view','id'=>$model->level_id)),
	array('label'=>'Manage Levels','url'=>array('admin')),
);
?>

<h1>Update Levels <?php echo $model->level_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>