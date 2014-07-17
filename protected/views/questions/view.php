<div class="well">
    <div class="row-fluid" id="<?=$data['question']->question_id ?>">

        <?php $this->renderPartial('_user_info',array('data'=>$data['question'], 'allAnswer' => $data['allAnswer'])) ?>

        <div class="span9">
            <div class="topic-heading">
                <h4><?=$data['question']->title?></h4>
                <?php echo tt('question level').': '.$data['question']->location_name;?>
                <span class="muted">
                    <i class="icon-time"></i> <?php echo tt('the voting ends in').': '.DateFormatHelper::getExpiredDate($data['userAnswer']->answers->date_last_update) ?>
                </span>
            </div>
            <div class="content"><?=$data['question']->text?></div>
        </div>
    </div>

    <div id="vote-block">
        <?php
        if(!$data['userAnswer']->answers->answers_array) {

            if($data['userAnswer']->answer != 1)
            {
                $imageUrl = Yii::app()->baseUrl.'/images/like.png';
                $likeImg = CHtml::image($imageUrl, 'like',array('width'=>25,'height'=>25));
                echo CHtml::link($likeImg, '#', array('data-vote' => 1, 'class' => 'btn btn-small vote', 'rel'=>"tooltip", 'title'=>tt('Yes'))).' ';
            }

            if($data['userAnswer']->answer != 2)
            {
                $imageUrl = Yii::app()->baseUrl.'/images/dislike.png';
                $dislikeImg = CHtml::image($imageUrl, 'dislike',array('width'=>25,'height'=>25));
                echo CHtml::link($dislikeImg, '#', array('data-vote' => 2, 'class' => 'btn btn-small vote', 'rel'=>"tooltip", 'title'=>tt('No'))).' ';
            }

            if($data['userAnswer']->answers->iteration_number == 1 && $data['userAnswer']->answer != 3)
                echo CHtml::link(tt('revision'), '#', array('data-vote' => 3, 'class' => 'btn btn-info vote')).'<p>';
        }
        ?>
    </div>
    
    <div id="answers-block">
        <?php 
                foreach ($data['allAnswer'] as $answerName => $answerCount)
                    echo '<div>'.tt($answerName).': '.$answerCount.'</div>';
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
