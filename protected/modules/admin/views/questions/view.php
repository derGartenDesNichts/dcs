<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->question_id,
);

$this->menu=array(
	array('label'=>'List Questions','url'=>array('index')),
	array('label'=>'Create Questions','url'=>array('create')),
	array('label'=>'Update Questions','url'=>array('update','id'=>$model->question_id)),
	array('label'=>'Delete Questions','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->question_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Questions','url'=>array('admin')),
);
?>

<h1>View Questions #<?php echo $model->question_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'question_id',
		'user_id',
		'level_id',
		'iteration_count',
		'answer',
		'text',
		'date_added',
		'expired_date',
		'result',
	),
)); ?>
