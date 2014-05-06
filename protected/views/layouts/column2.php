<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php
/* @var $this SiteController
@var $newQuestions Questions */

$this->pageTitle=Yii::app()->name;

$avatarUrl = (isset(Yii::app()->user->avatar) && (!empty(Yii::app()->user->avatar))) ?
    Yii::app()->createUrl('../uploads/user-full/'.Yii::app()->user->avatar) :
    Yii::app()->createUrl('../images/logo.jpg');
?>



<?php
$this->menu=array(
    array('label'=>CHtml::image($avatarUrl), 'url'=>'#'),
    array('label'=>tt('Profile'), 'url'=>array('/user/profile')),
    array(
        'label'=>(Yii::app()->user->model()->amountOfUnreadMessages)? tt('My Messages').' <b>('.Yii::app()->user->model()->amountOfUnreadMessages.')</b>': tt('My Messages'),
        'url'=>array('/messages/LastUsersList')),
    array('label'=>tt('Propositions'), 'url'=>array('/questions/list')),
    array('label'=>tt('Create Proposition'), 'url'=>array('/questions/new')),
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
