<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

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
