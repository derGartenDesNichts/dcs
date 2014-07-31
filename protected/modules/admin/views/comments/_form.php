<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'question_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php $this->widget('ext.redactorWidget.ImperaviRedactorWidget',array(
        'model'=>$model,
        'attribute'=>'text',
        'name'=>'redactor',
        'options'=>array(
            'minHeight'=>200,
            'convertVideoLinks'=> true,
            'convertImageLinks'=> true,
            'fileUpload'=>Yii::app()->createUrl('comments/upload'),
            'convertLinks'=>true
        ),
    )); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
