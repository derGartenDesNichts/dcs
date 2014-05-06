<?php /* @var $model Messages*/
?>
<div id="messages-div">
	<ul class="nav nav-tabs hisory-list">
		<li><strong class="tab-title">Show messages from:</strong></li>
			<?php
			
			$text = 'last 24 hours';
			if ($limitation == 1)
				echo '<li class="active"><span>'.$text.'</span></li>';
			else
				echo '<li>'.CHtml::link(
					$text,
					Yii::app()->createUrl('messages/conversationwith', array('userId'=>$userId, 'limitation' => 1))
				).'</li>';
			
			?>
			<?php
			$text = 'last 7 day';
			if ($limitation == 2)
				echo '<li class="active"><span>'.$text.'</span></li>';
			else
				echo '<li>'.CHtml::link(
					$text,
					Yii::app()->createUrl('messages/conversationwith', array('userId'=>$userId, 'limitation' => 2))
				).'</li>';
			?>
			<?php
			$text = 'all';
			if ($limitation == 3)
				echo '<li class="active"><span>'.$text.'</span></li>';
			else
				echo '<li>'.CHtml::link(
					$text,
					Yii::app()->createUrl('messages/conversationwith', array('userId'=>$userId, 'limitation' => 3))
				).'</li>';
			?>
	</ul>
	<div class="message-list">
		<?php
            $user_1 = Yii::app()->user->model();
            $user_2 = User::model()->findByPk($userId);
            $lastMessage = '';

			$html = '';
			foreach ($messages as $message) {

                $isMe = $message['user_from'] == $currUserId;

                $class = $isMe ? 'odd' : 'even';
                $name  = $isMe
                            ? $user_1->username
                            : $user_2->username;

				$html .= '<div class="well well-small '.$class.'">
							<div class="topic-heading" id="'.$message['id'].'">
								<span class="author">
									'.$name.'
								</span>
								<span class="muted pull-right">
									'.$message['created'].'
								</span>
							</div>
							'.$message['text'].'
						  </div>';
                $lastMessage = $message['id'];
			}
			echo $html;
		?>
	</div>
	<!-- ADD MESSAGE FORM -->
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'horizontalForm',
        'action' => Yii::app()->createUrl('/messages/conversationwith', array('userId' => $userId, '#' => $lastMessage)),
        'type' => 'horizontal',
        'htmlOptions' => array(
            'class' => 'wysiwyg-form'
        )
    )); ?>
    <strong class="content-title">Send Message</strong>

    <div class="control-group">
        <?php
        if ($model->hasErrors()) {
            ?>
            <div class="alert alert-block alert-error">
                <p>Please fix the following input errors:</p>
                <ul>
                    <?php
                    foreach ($model->errors as $error) {
                        echo '<li>' . $error[0] . '</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php
        }
        ?>
        <?php
        $this->widget('ext.redactorWidget.ImperaviRedactorWidget', array(
            'model' => $model,
            'attribute' => 'text',
            'name' => 'redactor',
            'options' => array(
                'convertVideoLinks' => true,
                'convertImageLinks' => true,
                'convertLinks' => true,
            ),
        ));
        ?>
    </div>
    <div class="control-group cleatfix">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'inverse', 'label' => 'Send', 'htmlOptions' => array('class' => 'pull-right'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>