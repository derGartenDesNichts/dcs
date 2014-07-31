<div class="span3">
    <strong class="user-title">
        <a href="<?php echo Yii::app()->createURL('user/profile/userProfile', array('id' => $data->user_id)); ?>">
            <?=$data->userProfile->first_name .' '. $data->userProfile->last_name ?>
        </a>
    </strong>
    <p><img class="img-rounded" alt="" src="<?=$data->userProfile->imageUrl?>"></p>
    <?php
    $isCurrentUser = $data->user_id  == Yii::app()->user->id;
    if (!$isCurrentUser)
        echo '<p>
                <a href="' . Yii::app()->createURL('messages/conversationWith', array('userId' => $data->user_id)) . '">
                    <i class="icon-envelope" rel="tooltip" title="'.tt('Send message').'"></i>'.tt('Send message').'
                </a>
             </p>';
    ?>
    <div id="answers-block">
        <?php 
            if(isset($allAnswer)) {
                foreach ($allAnswer as $answerName => $answerCount)
                    echo '<p><b>'.tt($answerName).'</b>: '.$answerCount.'</p>';
            }
        ?>
    </div>
</div>