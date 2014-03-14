<?php
Yii::app()->clientScript->registerPackage('timepicker');
Yii::app()->clientScript->registerScriptFile('/js/questions.js', CClientScript::POS_END);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'questions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'level_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'iteration_count',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'answer',array('class'=>'span5','maxlength'=>255)); ?>

	<?php $this->widget('ext.redactorWidget.ImperaviRedactorWidget',array(
        'model'=>$model,
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


	<?php echo $form->textFieldRow($model,'expired_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
