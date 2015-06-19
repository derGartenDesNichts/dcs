<div class="well" id="well-left">
    <div class="row-fluid row-fluid-view" id="<?=$data['question']->question_id ?>">

        <?php $this->renderPartial('user_info/_view',array('data'=>$data['question'], 'allAnswer' => $data['allAnswer'])) ?>
        
        <div class="span9">
            <div class="topic-heading-view">
                <h4><?=$data['question']->title?></h4>
                <?php echo tt('question level').': '.$data['question']->location_name;?>
                <br>
                <br>
                <span class="muted">
                    <i class="icon-time"></i> <?php
                    if(!empty($data['userAnswer']->answers->date_last_update))
                        echo tt('the voting ends in').': '.DateFormatHelper::getExpiredDate($data['question']->date_added, $data['question']->iteration_count);
                    
                    if($data['userAnswer']->answers->iteration_number != $data['question']->iteration_count)  
                        echo '</br><i class="icon-time"></i> '.tt('the voting of current iteration ends in').': '.DateFormatHelper::getExpiredDate($data['userAnswer']->answers->date_last_update);
                    ?>
                </span>
            </div>
            <div class="content-view"><?=$data['question']->text?></div>
        </div>
            
    </div>
    <br>

    <div id="vote-block">
        <p>
        <?php
        if(!$data['userAnswer']->answers->answers_array) {

            if($data['userAnswer']->answer != 1)
            {
                $imageUrl = Yii::app()->baseUrl.'/images/like.png';
                $likeImg = CHtml::image($imageUrl, 'like',array('width'=>25,'height'=>25));
                echo CHtml::link($likeImg, '#', array('data-vote' => 1, 'class' => 'flat grey vote', 'rel'=>"tooltip", 'title'=>tt('Yes')));
            }

            if($data['userAnswer']->answer != 2)
            {
                $imageUrl = Yii::app()->baseUrl.'/images/dislike.png';
                $dislikeImg = CHtml::image($imageUrl, 'dislike',array('width'=>25,'height'=>25));
                echo CHtml::link($dislikeImg, '#', array('data-vote' => 2, 'class' => 'flat grey vote', 'rel'=>"tooltip", 'title'=>tt('No')));
            }

            if($data['userAnswer']->answers->iteration_number == 1 && $data['userAnswer']->answer != 3)
                echo CHtml::link(tt('revision'), '#', array('data-vote' => 3, 'class' => 'flat vote'));
        }
        ?>
        </p>
    </div>
    
    <div id="answers-block">
        <?php 
            /*    foreach ($data['allAnswer'] as $answerName => $answerCount)
                    echo '<div>'.tt($answerName).': '.$answerCount.'</div>';*/
        ?>
    </div>
<!--
    <div align="right"><a class="flat" href="#post-reply" id="post-reply"><?php echo tt('Add Comment') ?></a></div>
-->
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
        'class' => 'topic-list comm',
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
/*
     $('#post-reply').on('click',function(e){
         $('#comment').removeClass('hidden');
         e.preventDefault();
     });

     $('#close-redactor').on('click',function(){
         $('#comment').addClass('hidden');
     });
*/

</script>
