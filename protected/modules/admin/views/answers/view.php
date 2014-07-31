<?php
$this->breadcrumbs=array(
	'Answers'=>array('index'),
	$model->answer_id,
);

$this->menu=array(
	array('label'=>'List Answers','url'=>array('index')),
	array('label'=>'Create Answers','url'=>array('create')),
	array('label'=>'Update Answers','url'=>array('update','id'=>$model->answer_id)),
	array('label'=>'Delete Answers','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->answer_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Answers','url'=>array('admin')),
);
?>

<h1>View Answers #<?php echo $model->answer_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'answer_id',
		'question_id',
		'iteration_number',
		'answers_array',
		'date_last_update',
	),
)); ?>
