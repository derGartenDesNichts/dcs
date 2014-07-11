<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php
/* @var $this SiteController
@var $newQuestions Questions */

$this->pageTitle=Yii::app()->name;
$avatar = Profile::model()->findByPk(Yii::app()->user->id)->getImageUrl(true);

$this->menu=array(

    array('label'=>'<div>'.CHtml::image($avatar).'</div>', 'url'=>'/user/profile'),
    array('label'=>tt('Profile'), 'url'=>array('/user/profile')),
    array(
        'label'=>(Yii::app()->user->model()->amountOfUnreadMessages)? tt('My Messages').' <b>('.Yii::app()->user->model()->amountOfUnreadMessages.')</b>': tt('My Messages'),
        'url'=>array('/messages/MessagesUsersList')),
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
