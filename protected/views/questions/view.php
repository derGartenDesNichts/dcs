<?php

echo $data['question']->title.'<p>'.$data['question']->text;
?>

<div id="vote-block">
<?php
if(!$data['userAnswer']->answers->answers_array) {  
    
    if($data['userAnswer']->answer != 1)
        echo CHtml::link('like', '#', array('data-vote' => 1, 'class' => 'vote')).'<p>';
    
    if($data['userAnswer']->answer != 2)
        echo CHtml::link('dislike', '#', array('data-vote' => 2, 'class' => 'vote')).'<p>';

    if($data['userAnswer']->answers->iteration_number == 1 && $data['userAnswer']->answer != 3)
        echo CHtml::link('revision', '#', array('data-vote' => 3, 'class' => 'vote')).'<p>';
}
?>
</div>
<script>
     $(document).on("click",".vote",function(e){
        $.ajax({
            url: "<?php echo $this->createUrl('questions/view', array('id' => $data['question']->question_id, 'voteId' => $data['userAnswer']->id)) ?>",
            data: 'vote='+$(this).data('vote'),
            success: function(data) {
              $('#vote-block').html($(data).find('#vote-block').html());
            }
        });
     });
    
</script>
