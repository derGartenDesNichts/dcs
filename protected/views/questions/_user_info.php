<div class="span3">
    <strong class="user-title">
        <a href="<?=Yii::app()->createURL('user/profile/userProfile', array('id' => $data->user_id))?>">
            <?=$data->userProfile->first_name .' '. $data->userProfile->last_name ?>
        </a>
    </strong>
    <img class="img-rounded" alt="" src="<?=$data->userProfile->imageUrl?>">
    <?php
    $isCurrentUser = $data->user_id  == Yii::app()->user->id;
    if (!$isCurrentUser) { ?>
        <p>
            <a href="<?=Yii::app()->createURL('messages/conversationWith', array('userId' => $data->user_id))?>">
                <i class="icon-envelope" rel="tooltip" title="<?=tt('Send message')?>"></i><?=tt('Send message')?>
            </a>
        </p>
    <?php } ?>
</div>