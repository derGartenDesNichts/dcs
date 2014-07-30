<?php
$this->breadcrumbs=array(
	'Answers',
);

$this->menu=array(
	array('label'=>'Create Answers','url'=>array('create')),
	array('label'=>'Manage Answers','url'=>array('admin')),
);
?>

<h1>Answers</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
