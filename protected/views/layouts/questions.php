<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/column2'); ?>

<div class="clearfix">
    <?php
    $this->widget('bootstrap.widgets.TbTabs',array(
            // 'htmlOptions'=>array('class'=>'clearfix'),
            'type'=>'tabs',
            'placement'=>'top',
            'tabs'=>array(
                array('label'=>Yii::t('trans', 'New'),'url'=>array('#'),'active'=>true),
                array('label'=>Yii::t('trans', 'My'),'url'=>array('#')),
                array('label'=>Yii::t('trans', 'Voted'),'url'=>array('#')),
                array('label'=>Yii::t('trans', 'In Performing'),'url'=>array('#')),
            ))
    );
    echo $content;
    ?>
</div>
<?php $this->endContent(); ?>
