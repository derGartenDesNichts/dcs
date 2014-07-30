<?php
Yii::app()->clientScript->registerLocalScript('profileForm.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('assignment',
    'var ajaxUrl = "'.Yii::app()->createUrl('/ajax/').'"',
    CClientScript::POS_HEAD);

?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>

		<?php //echo $form->labelEx($model,'password'); ?>
		<?php //echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php //echo $form->error($model,'password'); ?>

		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>

		<?php echo $form->labelEx($model,'superuser'); ?>
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo $form->error($model,'superuser'); ?>

		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
<?php
		$profileFields=Profile::getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
			<?php
			}
		}
?>
    <label>
        <?php echo tt('Country') ?>
    </label>
    <?php echo LocationHelper::getCountryDropdown()?>

    <?php

    if(!empty($model->users_locations))
    {
        foreach ($model->users_locations as $location) {

            if($location->locations->level_id == 2)
            {
                echo '<label>'.tt('District').'</label>'.
                LocationHelper::getDistricts($location->locations->place_id);
                $districtId = $location->locations->place_id;
            }

            if($location->locations->level_id == 3)
            {
                echo '<label>'.tt('City').'</label>'.
                LocationHelper::getCities($location->locations->place_id, $districtId);
            }

        }
    }
    else
    {
        echo '<label>'.tt('District').'</label>'.
        LocationHelper::getDistricts();

        echo '<label>'.tt('City').'</label>'.
        LocationHelper::getCities();
    }

    ?>

    <div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class'=>'btn btn-success')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->