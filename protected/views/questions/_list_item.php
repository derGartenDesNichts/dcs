<div class="well">
    <div class="row-fluid" id="<?= $data->question_id ?>">
        <div class="span3">
            <strong class="user-title">
                <a href="<?php echo Yii::app()->createURL('user/profile/userProfile', array('id' => $data->user_id)); ?>">
                    <?=$data->user->username ?>
                </a>
            </strong>
        <?php
        if (!empty($data->userProfile->avatar))
        echo '<img class="img-rounded" alt="" src="uploads/user-full/' . $data->userProfile->avatar . '">';
        ?>
        </div>
        <div class="span9">
            <div class="topic-heading">
                <h4><?=CHtml::link($data->title, Yii::app()->createUrl('questions/view', array('id' => $data->question_id)))?></h4>
                            <span class="muted">
                                <i class="icon-time"></i> <?php echo DateFormatHelper::setCustomDate($data->date_added) ?>
                            </span>
            </div>
        <div class="content"><?php

        $text = explode("<br /><br />",$data->text);

        if(isset($text) && !empty($text))
        {
            if(count($text)>1)  echo array_shift($text)."<br ><br />".array_shift($text)."<br ><br />";
            else echo $data->text;
        }

        ?>
    </div>
    <div align="right"><a class="btn btn-info" href="<?=Yii::app()->createUrl('questions/view', array('id' => $data->question_id))?>"><?php echo tt('Read More') ?></a></div>
</div>
</div>
</div>
