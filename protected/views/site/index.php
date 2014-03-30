<?php
/* @var $this SiteController
   @var $newQuestions Questions */

$this->pageTitle=Yii::app()->name;

$this->menu=array(
    array('label'=>CHtml::image('/../uploads/user-full/'.Yii::app()->user->avatar), 'url'=>'#'),
    array('label'=>'Profile', 'url'=>array('/user/profile')),
    array('label'=>'Propositions', 'url'=>array('#')),
    array('label'=>'Create Proposition', 'url'=>array('#')),
);
?>
<div class="clearfix">
    <?php
    $this->widget('bootstrap.widgets.TbTabs',array(
       // 'htmlOptions'=>array('class'=>'clearfix'),
        'type'=>'tabs',
        'placement'=>'top',
        'tabs'=>array(
            array('label'=>'New','url'=>array('#'),'active'=>true),
            array('label'=>'My','url'=>array('#')),
            array('label'=>'Voted','url'=>array('#')),
            array('label'=>'In Performing','url'=>array('#')),
        ))
    );
    $this->renderPartial('/questions/new');
    ?>
</div>
