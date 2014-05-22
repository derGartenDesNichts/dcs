<?php
$messages = new Messages;
$lastMessage = $messages->getLastMessage($data->id,Yii::app()->user->id);
if(!empty($lastMessage))
{
    $lastMessageDate = DateFormatHelper::setCustomDate($lastMessage->created);
    $messageId = $lastMessage->id;
}
else
{
    $lastMessageDate = '';
    $messageId = '';
}
?>
<div class="user-item well <?php echo ($data->getAmountOfUnreadMessages($data->id)) ? 'well-blue' : 'well-white' ?>" onclick="return location.href='<?php echo Yii::app()->createUrl('messages/conversationwith', array('userId' => $data->id, '#'=> $messageId))?>'">
	<div class="photo-holder">
		<a href="#">
			<?php echo CHtml::image(Yii::app()->createUrl($data->profile->imageUrl));?>
		</a>
	</div>
	<div class="text-holder">
        <div class="span4">
            <strong class="user-name">
                <a href="#"><?php echo $data->username?></a>
            </strong>
            <p><strong>Last message:  </strong><?php echo $lastMessageDate ?></p>
        </div>
        <div class="span4">
            <?php echo PreviewTextCuter::cut($lastMessage->text); ?>
        </div>
    </div>
</div>
