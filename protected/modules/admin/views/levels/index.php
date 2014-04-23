<?php
$this->breadcrumbs=array(
	'Levels',
);

$this->menu=array(
	array('label'=>'Create Levels','url'=>array('create')),
	array('label'=>'Manage Levels','url'=>array('admin')),
);
?>

<h1>Levels</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
