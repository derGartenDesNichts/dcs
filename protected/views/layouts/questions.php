<?php /* @var $this Controller */ ?>
<?php
$this->beginContent('//layouts/column2'); 

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/questions/layout.js");
?>

<div class="clearfix">
    <?php
    if($this->listItem == 'new')
        $new = true;
    else
        $new = false;
    
    $this->widget('bootstrap.widgets.TbTabs',array(
            // 'htmlOptions'=>array('class'=>'clearfix'),
            'type'=>'tabs',
            'placement'=>'top',
            'tabs'=>array(
                array('label'=>tt('New'), 'id'=>'new','url'=>array('#'), 'active' => $new),
                array('label'=>tt('My'), 'id'=>'my','url'=>array('#')),
                array('label'=>tt('Voted'), 'id'=>'voted','url'=>array('#')),
                array('label'=>tt('In Performing'), 'id'=>'performing','url'=>array('#')),
                array('label'=>tt('Denied'), 'id'=>'denied','url'=>array('#')),
                array('label'=>tt('On Revision'), 'id'=>'revision','url'=>array('#')),
            ),
        )
    );
    echo '<div id="replace-content">'.$content.'</div>';
    ?>
</div>
<?php $this->endContent(); ?>