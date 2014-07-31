<?php
$this->breadcrumbs=array(
	'Linkings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Linking','url'=>array('index')),
	array('label'=>'Manage Linking','url'=>array('admin')),
);
?>

<h1>Create Linking</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>