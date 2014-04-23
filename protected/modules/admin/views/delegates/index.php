<?php
$this->breadcrumbs=array(
	'Delegates',
);

$this->menu=array(
	array('label'=>'Create Delegates','url'=>array('create')),
	array('label'=>'Manage Delegates','url'=>array('admin')),
);
?>

<h1>Delegates</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
