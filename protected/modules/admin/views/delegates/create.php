<?php
$this->breadcrumbs=array(
	'Delegates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Delegates','url'=>array('index')),
	array('label'=>'Manage Delegates','url'=>array('admin')),
);
?>

<h1>Create Delegates</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>