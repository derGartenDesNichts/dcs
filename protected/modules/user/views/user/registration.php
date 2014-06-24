<?php
Yii::app()->clientScript->registerLocalScript('profileForm.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('assignment',
    'var ajaxUrl = "'.Yii::app()->createUrl('/ajax/').'"',
    CClientScript::POS_HEAD);

$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model,$profile)); ?>
	
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username'); ?>
	<?php echo $form->error($model,'username'); ?>

	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>

	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>

	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email'); ?>
	<?php echo $form->error($model,'email'); ?>

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
			echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
			<?php
			}
		}
?>
    <h5><?php echo tt('Location')?></h5>

    <label>
        <?php echo tt('Country') ?>
    </label>
    <?php echo LocationHelper::getCountryDropdown()?>

    <label>
        <?php echo tt('District') ?>
    </label>
    <?php echo LocationHelper::getDistricts()?>

    <label>
        <?php echo tt('City') ?>
    </label>
    <?php echo LocationHelper::getCities()?>

    <!--<label>
        <?php /*echo tt('Street') ?>
    </label>
    <input type="text" name="UserLocation[street]">

    <label>
        <?php echo tt('House number') ?>
    </label>
    <input type="text" name="UserLocation[house]">

    <label>
        <?php echo tt('Apartment number')*/ ?>
    </label>
    <input type="text" name="UserLocation[apartment]">-->

	<?php if (UserModule::doCaptcha('registration')): ?>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	<?php endif; ?>

    <?php echo CHtml::submitButton(UserModule::t("Register"),array('class'=>'btn btn-info')); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>