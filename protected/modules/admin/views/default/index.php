<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<p><a href="<?php echo Yii::app()->createUrl('user/admin/admin')?>">Manage Users</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/answers/admin')?>">Manage Answers</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/comments/admin')?>">Manage Comments</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/delegates/admin')?>">Manage Delegates</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/levels/admin')?>">Manage Levels</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/linking/admin')?>">Manage Linking</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/locations/admin')?>">Manage Locations</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/admin/questions/admin')?>">Manage Questions</a></p>