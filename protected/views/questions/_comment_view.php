<div class="well">
    <div class="row-fluid" id="<?= $data->comment_id ?>">
        <div class="span3">
            <strong class="user-title">
                <a href="<?php echo Yii::app()->createURL('user/profile/userProfile', array('id' => $data->user_id)); ?>">
                    <?=$data->userProfile->first_name .' '. $data->userProfile->last_name ?>
                </a>
            </strong>
            <?php
            if (!empty($data->userProfile->avatar))
                echo '<img class="img-rounded" alt="" src="'.Yii::app()->baseUrl.'/uploads/user-full/' . $data->userProfile->avatar . '">';
            else
                echo '<img class="img-rounded" alt="" src="'.Yii::app()->baseUrl.'/images/logo.jpg">';


            $isCurrentUser = $data->user_id  == Yii::app()->user->id;
            if (!$isCurrentUser)
                echo '<p>
                    <a href="' . Yii::app()->createURL('messages/conversationWith', array('userId' => $data->user_id)) . '">
                        <i class="icon-envelope" rel="tooltip" title="'.tt('Send message').'"></i>'.tt('Send message').'
                    </a>
                 </p>';

            ?>
        </div>
        <div class="span9">
            <div class="topic-heading">
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
        </div>
    </div>
</div>
