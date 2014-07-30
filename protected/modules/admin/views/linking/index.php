<?php
$this->breadcrumbs=array(
	'Linkings',
);

$this->menu=array(
	array('label'=>'Create Linking','url'=>array('create')),
	array('label'=>'Manage Linking','url'=>array('admin')),
);
?>

<h1>Linkings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
