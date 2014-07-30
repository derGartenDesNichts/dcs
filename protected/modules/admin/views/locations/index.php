<?php
$this->breadcrumbs=array(
	'Locations',
);

$this->menu=array(
	array('label'=>'Create Locations','url'=>array('create')),
	array('label'=>'Manage Locations','url'=>array('admin')),
);
?>

<h1>Locations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
