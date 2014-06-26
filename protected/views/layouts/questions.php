<?php /* @var $this Controller */ ?>
<?php 
$this->beginContent('//layouts/column2'); 

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/questions/layout.js");
?>

<div class="clearfix">
    <?php
    $this->widget('bootstrap.widgets.TbTabs',array(
            // 'htmlOptions'=>array('class'=>'clearfix'),
            'type'=>'tabs',
            'placement'=>'top',
            'tabs'=>array(
                array('label'=>tt('New'), 'id'=>'new','url'=>array('#'), 'active' => true),
                array('label'=>tt('My'), 'id'=>'my','url'=>array('#')),
                array('label'=>tt('Voted'), 'id'=>'voted','url'=>array('#')),
                array('label'=>tt('In Performing'), 'id'=>'performing','url'=>array('#')),
            ),
        )
    );
    echo '<div id="replace-content">'.$content.'</div>';
    ?>
</div>
<?php $this->endContent(); ?>