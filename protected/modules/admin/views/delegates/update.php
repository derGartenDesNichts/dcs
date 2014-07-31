<?php
$this->breadcrumbs=array(
	'Delegates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Delegates','url'=>array('index')),
	array('label'=>'Create Delegates','url'=>array('create')),
	array('label'=>'View Delegates','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Delegates','url'=>array('admin')),
);
?>

<h1>Update Delegates <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>