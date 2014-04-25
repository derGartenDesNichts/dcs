<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php
/* @var $this SiteController
@var $newQuestions Questions */

$this->pageTitle=Yii::app()->name;
$avatarUrl = (isset(Yii::app()->user->avatar) && (!empty(Yii::app()->user->avatar))) ? Yii::app()->createUrl('uploads/user-full/'.Yii::app()->user->avatar) : Yii::app()->createUrl('images/logo.jpg');
?>

<?php $this->widget('LanguageSwitcherWidget'); ?>

<?php
$this->menu=array(
    array('label'=>CHtml::image($avatarUrl), 'url'=>'#'),
    array('label'=>Yii::t('trans','Profile'), 'url'=>array('/user/profile')),
    array('label'=>Yii::t('trans','Propositions'), 'url'=>array('/questions/list')),
    array('label'=>Yii::t('trans', 'Create Proposition'), 'url'=>array('/questions/new')),
);
?>

<div class="main-col2 clearfix">
    <div id="content">
        <div class="c1">
            <?php echo $content; ?>
        </div>
    </div><!-- content -->

    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet');
        $this->widget('bootstrap.widgets.TbMenu', array(
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'nav-list nav-side'),
            'encodeLabel'=>false,
        ));
        $this->endWidget();
        ?>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
