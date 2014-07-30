<?php 

$userAnswer = UsersAnswers::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'question_id' => $data->question_id)); 
$allAnswer = UsersAnswers::model()->getCountOfAnswers($data->question_id);

?>
<div class="well">
    <div class="row-fluid" id="<?=$data->question_id?>">

        <?php $this->renderPartial('_user_info',array('data'=>$data, 'allAnswer' => $allAnswer)) ?>
        <div class="span9">
            <div class="topic-heading">
                <h4><?=CHtml::link($data->title, Yii::app()->createUrl('questions/view', array('id' => $data->question_id)))?></h4>
                <?php echo tt('question level').': '.$data->location_name;?>
                <span class="muted">
                    <i class="icon-time"></i> <?php echo tt('the voting ends in').': '.DateFormatHelper::getExpiredDate($userAnswer->answers->date_last_update) ?> <?php echo tt('All comments').' '.Comments::model()->getCommentsCount($data->question_id)?>
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

            <div align="right">
                <a class="btn btn-info" href="<?=Yii::app()->createUrl('questions/view', array('id' => $data->question_id))?>">
                    <?=tt('Read More')?>
                </a>
            </div>

        </div>
    </div>
</div>
