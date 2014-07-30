<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('answer_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->answer_id),array('view','id'=>$data->answer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question_id')); ?>:</b>
	<?php echo CHtml::encode($data->question_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iteration_number')); ?>:</b>
	<?php echo CHtml::encode($data->iteration_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('answers_array')); ?>:</b>
	<?php echo CHtml::encode($data->answers_array); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_last_update')); ?>:</b>
	<?php echo CHtml::encode($data->date_last_update); ?>
	<br />


</div>