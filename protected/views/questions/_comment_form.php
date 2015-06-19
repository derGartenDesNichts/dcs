<div class="comm_form" id="comment">
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
       /* $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'info',
            'label'=>tt('Add Comment'),
            'htmlOptions' => array(
                'id'=>'save-btn'
            ),
        ));*/ ?>
        <button type="submit" class="flat big" id='save-btn'><?=tt('Add Comment')?></button>
                <?php
        /*$this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'danger',
            'label'=>tt('Cancel'),
            'htmlOptions' => array(
                'id'=>'close-redactor',
                'name'=>$answer_id
            ),
        ));*/ ?>
    </div>



    <?php $this->endWidget(); ?>
</div>