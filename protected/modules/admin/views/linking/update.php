<?php
$this->breadcrumbs=array(
	'Linkings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Linking','url'=>array('index')),
	array('label'=>'Create Linking','url'=>array('create')),
	array('label'=>'View Linking','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Linking','url'=>array('admin')),
);
?>

<h1>Update Linking <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>