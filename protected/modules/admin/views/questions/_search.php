<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'question_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'level_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'iteration_count',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'answer',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'text',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'date_added',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'expired_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
