<?php
$this->breadcrumbs=array(
	'Answers'=>array('index'),
	$model->answer_id=>array('view','id'=>$model->answer_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Answers','url'=>array('index')),
	array('label'=>'Create Answers','url'=>array('create')),
	array('label'=>'View Answers','url'=>array('view','id'=>$model->answer_id)),
	array('label'=>'Manage Answers','url'=>array('admin')),
);
?>

<h1>Update Answers <?php echo $model->answer_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>