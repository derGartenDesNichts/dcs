
<h1>Add New Proposition</h1>

<?php if(@$success): ?>

<div class="flash-success">
	<?php echo 'success'; ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 

$levels = Locations::model()->getUserLocations();
$list = array();

foreach ($levels as $level)
    $list[$level['location_id']] = $level['description'];

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($data); ?>
    
    <div class="row">
		<?php echo $form->labelEx($data,'level_id'); ?>
		<?php echo $form->dropDownList($data,'level_id',$list); ?>
		<?php echo $form->error($data,'level_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($data,'answer'); ?>
		<?php echo $form->textArea($data,'answer',array('rows'=>2, 'cols'=>250)); ?>
		<?php echo $form->error($data,'answer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($data,'text'); ?>
		<?php echo $form->textArea($data,'text',array('rows'=>6, 'cols'=>250)); ?>
		<?php echo $form->error($data,'text'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>