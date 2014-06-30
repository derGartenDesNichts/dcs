<div class="well">
    <div class="row-fluid" id="<?= $data['question']->question_id ?>">
        <div class="span3">
            <strong class="user-title">
                <a href="<?php echo Yii::app()->createURL('user/profile/userProfile', array('id' => $data['question']->user_id)); ?>">
                    <?=$data['question']->user->username ?>
                </a>
            </strong>
            <?php
            if (!empty($data['question']->userProfile->avatar))
                echo '<img class="img-rounded" alt="" src="uploads/user-full/' . $data['question']->userProfile->avatar . '">';
            ?>
        </div>
        <div class="span9">
            <div class="topic-heading">
                <h4><?=$data['question']->title?></h4>
                            <span class="muted">
                                <i class="icon-time"></i> <?php echo DateFormatHelper::setCustomDate($data['question']->date_added) ?>
                            </span>
            </div>
            <div class="content"><?=$data['question']->text; ?>
            </div>


        </div>
    </div>

    <div id="vote-block">
        <?php
        if(!$data['userAnswer']->answers->answers_array) {

            if($data['userAnswer']->answer != 1)
                echo CHtml::link(tt('like'), '#', array('data-vote' => 1, 'class' => 'vote')).'<p>';

            if($data['userAnswer']->answer != 2)
                echo CHtml::link(tt('dislike'), '#', array('data-vote' => 2, 'class' => 'vote')).'<p>';

            if($data['userAnswer']->answers->iteration_number == 1 && $data['userAnswer']->answer != 3)
                echo CHtml::link(tt('revision'), '#', array('data-vote' => 3, 'class' => 'vote')).'<p>';
        }
        ?>
    </div>
    
    <div id="answers-block">
        <?php 
                foreach ($data['allAnswer'] as $answerName => $answerCount)
                    echo tt($answerName).': '.$answerCount.'<p>';
        ?>
    </div>

    <div align="right"><a class="btn btn-info" href="#post-reply" id="post-reply"><?php echo tt('Add Comment') ?></a></div>

</div>

<?php

$this->renderPartial('/questions/_comment_form',array('model'=>new Comments,'answer_id'=>$data['userAnswer']->answer_id));

$this->widget('bootstrap.widgets.TbListView', array(
    'id'=>'new-questions-qrid',
    'template'=>"{items}{pager}",
    'dataProvider'=> Comments::model()->getComments($data['userAnswer']->answer_id),
    'itemView'=>'/questions/_comment_view',
    'summaryText'=>false,
    'ajaxUpdate' => false,
    'emptyText' => tt('no comments'),
    'htmlOptions' => array(
        'class' => 'topic-list'
    ),
));
?>


<script>
     $(document).on("click",".vote",function(e){
        $.ajax({
            url: "<?php echo $this->createUrl('questions/view', array('id' => $data['question']->question_id, 'voteId' => $data['userAnswer']->id)) ?>",
            data: 'vote='+$(this).data('vote'),
            success: function(data) {
              $('#vote-block').html($(data).find('#vote-block').html());
              $('#answers-block').html($(data).find('#answers-block').html());
            }
        });
     });

     $('#post-reply').on('click',function(){
         $('#comment').removeClass('hidden');
     });


</script>
