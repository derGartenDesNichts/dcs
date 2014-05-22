<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/column2'); ?>

<div class="clearfix">
    <?php
    $this->widget('bootstrap.widgets.TbTabs',array(
            // 'htmlOptions'=>array('class'=>'clearfix'),
            'type'=>'tabs',
            'placement'=>'top',
            'tabs'=>array(
                array('label'=>tt('New'),'url'=>array('#'),'active'=>true),
                array('label'=>tt('My'),'url'=>array('#')),
                array('label'=>tt('Voted'),'url'=>array('#')),
                array('label'=>tt('In Performing'),'url'=>array('#')),
            ))
    );
    echo $content;
    ?>
</div>
<?php $this->endContent(); ?>
