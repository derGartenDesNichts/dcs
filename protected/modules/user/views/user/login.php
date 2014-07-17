<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>true,
    'htmlOptions'=>array('class'=>'form-login'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); /* @var $form TbActiveForm */ ?>

    <h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage') || Yii::app()->user->hasFlash('recoveryMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
        <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
    </div>

<?php endif; ?>

<?php echo $form->errorSummary($model, 'Following errors occurred'); ?>

    <div class="controls-row">
        <?php echo $form->textField($model,'username', array('class'=>'input-block-level', 'placeholder'=>'Email')); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="controls-row">
        <?php echo $form->passwordField($model,'password', array('class'=>'input-block-level', 'placeholder'=>'Password')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

    <div class="clearfix">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'size'=>'large',
            'label'=>'Login',
            'htmlOptions'=>array('class'=>'pull-left'),
        )); ?>
        <ul class="action-links">
            <?php //echo '<li>'.CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl).'</li>'; ?>
            <?php echo '<li>'.CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl).'</li>'; ?>
        </ul>
    </div>

<?php $this->endWidget(); ?>