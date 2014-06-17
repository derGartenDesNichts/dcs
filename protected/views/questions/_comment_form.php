<div class="hidden" id="comment">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'comment-form',
        'enableAjaxValidation'=>false,
        'action'=>Yii::app()->createUrl('/answers/AddComment',array('answer_id'=>$answer_id,))
    ));

    ?>

    <?php echo $form->errorSummary($model); ?>

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
    ));

    ?>

    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Add Comment',
            'htmlOptions' => array(
                'id'=>'save-btn'
            ),
        )); ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'label'=>'Cancel',
            'htmlOptions' => array(
                'id'=>'close-redactor',
                'name'=>$answer_id
            ),
        )); ?>
    </div>



    <?php $this->endWidget(); ?>
</div>