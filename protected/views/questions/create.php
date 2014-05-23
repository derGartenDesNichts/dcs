<h3><?php echo tt('Add New Proposition') ?></h3>

<?php if(@$success):?>

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

	<p class="note"><?php echo tt('Fields with') ?> <span class="required">*</span> <?php echo tt('are required')?>.</p>

	<?php echo $form->errorSummary($data); ?>
    
		<?php echo $form->labelEx($data,'level_id'); ?>
		<?php echo $form->dropDownList($data,'level_id',$list); ?>
		<?php echo $form->error($data,'level_id'); ?>

		<?php echo $form->labelEx($data,'title'); ?>
		<?php echo $form->textArea($data,'title',array('rows'=>1, 'cols'=>250)); ?>
		<?php echo $form->error($data,'title'); ?>

		<?php echo $form->labelEx($data,'text'); ?>
		<?php
        $this->widget('ext.redactorWidget.ImperaviRedactorWidget',array(
            'model'=>$data,
            'attribute'=>'text',
            'name'=>'redactor',
            'options'=>array(
                'minHeight'=>200,
                'convertVideoLinks'=> true,
                'convertImageLinks'=> true,
                'fileUpload'=>Yii::app()->createUrl('questions/upload'),
                'convertLinks'=>true
            ),
        )); ?>

		<?php echo $form->error($data,'text'); ?>


	<div class="buttons">
		<?php echo CHtml::submitButton(tt('Submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>