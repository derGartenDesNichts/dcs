<?php
/**
 * Class for management crons.
 */
class CronCommand extends CConsoleCommand
{
    
    public function actionCheckVotes()
    {
        $answers = Answers::model()->getExpiredAnswers();
        
        $questions = array();
        
        foreach ($answers as $answer) {
            $userAnswers = UsersAnswers::model()->getCountOfAnswers($answer->question_id, $answer->answer_id);
            if($answer->iteration_number == 1 && $userAnswers['revision'] > $userAnswers['likes'] && $userAnswers['revision'] > $userAnswers['dislikes']) {
                Questions::model()->updateByPk($answer->question_id, array('result' => 'revision'));
                $answer->answers_array = 'revision';
            } else {
                if($userAnswers['likes'] > $userAnswers['dislikes'])
                    $answer->answers_array = 'likes';
                else
                    $answer->answers_array = 'dislikes';
                
                $questions[$answer->question_id] = $answer->iteration_number;                
            }
            $answer->likes = $userAnswers['likes'];
            $answer->dislikes = $userAnswers['dislikes'];
            $answer->revision = $userAnswers['revision'];
            $answer->update();
        }
        
        foreach ($questions as $questionId => $iteration) {
            
            $question = Questions::model()->findByPk($questionId);
            // Vote finished
            if($question->iteration_count == $iteration) {
                $votes = UsersAnswers::model()->getCountOfAnswers($questionId);
                if($votes['likes'] > $votes['dislikes'])
                    $question->result = 'likes';
                else
                    $question->result = 'dislikes';
                
                $question->expired_date = date("Y-m-d H:i:s");
                $question->update();
            } else {
                $votes = UsersAnswers::model()->getCountOfAnswers($questionId);
                
                // Iteration update
                if($votes['likes'] > $votes['dislikes']) {
                    $newIteration = $iteration + 1;
                    $users = User::model()->getRandomUsersByLocation($question->level_id, $newIteration*100);
                }
                else {
                    $question->result = 'dislikes';
                    $question->expired_date = date("Y-m-d H:i:s");
                    $question->update();
                }
            }
        }
    }
}