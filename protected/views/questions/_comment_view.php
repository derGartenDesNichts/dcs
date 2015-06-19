
<div class="well ">
    <div class="row-fluid comment-user" id="<?=$data->comment_id ?>">
        <img class="img-rounded comment-user-avatar" alt="" src="<?=$data->userProfile->imageUrl?>">  
        <div>
            <a href="<?php echo Yii::app()->createURL('user/profile/userProfile', array('id' => $data->user_id)); ?>">
                <?=$data->userProfile->first_name .' '. $data->userProfile->last_name ?>
            </a>
            <span class="comment-time"><i class="icon-time"></i><?=DateFormatHelper::setCustomDate($data->date_added)?></span>
        </div>
        <?=$data->text?>
    </div>
</div>
