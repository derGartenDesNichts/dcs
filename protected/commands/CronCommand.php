<?php
/**
 * Class for management crons.
 */
class CronCommand extends CConsoleCommand
{
    
    public function actionCheckVotes()
    {
        //delete revisions which didnt update on iteration time
        $answers = Answers::model()->getExpiredAnswers('revision');
        foreach ($answers as $answer) {
            Questions::model()->updateByPk($answer->question_id, array('result' => 'dislikes'));
            $answer->answers_array = 'dislikes';
            $answer->save();
        }
        
        
        //update new expired answers
        $answers = Answers::model()->getExpiredAnswers();
        
        $questions = array();
        
        foreach ($answers as $answer) {
            $userAnswers = UsersAnswers::model()->getCountOfAnswers($answer->question_id, $answer->answer_id);
            if($answer->iteration_number == 1 && $userAnswers['revision'] > $userAnswers['likes'] && $userAnswers['revision'] > $userAnswers['dislikes']) {
                Questions::model()->updateByPk($answer->question_id, array('result' => 'revision'));
                $answer->answers_array = 'revision';
                $answer->date_last_update = date("Y-m-d H:i:s");
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
            // If vote finished
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
                    //2^64-1
                    if($question->iteration_count == $newIteration)
                        $limit = 2^64-1;
                    else {
                        $limit = 100*(10^$newIteration);
                    }
                    $users = User::model()->getRandomUsersByLocation($question->level_id, $limit, $questionId);
                    
                    $answer = new Answers;
                    $answer->question_id = $questionId;
                    $answer->iteration_number = $newIteration;
                    $answer->date_last_update = date("Y-m-d H:i:s");
                    $answer->save();
                    
                    $userCount = 0;
                    
                    foreach ($users as $user) {
                        
                        if($userCount == 100) {
                            $userCount = 0;
                            $answer = new Answers;
                            $answer->question_id = $questionId;
                            $answer->iteration_number = $newIteration;
                            $answer->date_last_update = date("Y-m-d H:i:s");
                            $answer->save();
                        }
                        
                        $userAnswer = new UsersAnswers;
                        $userAnswer->user_id = $user['id'];
                        $userAnswer->answer_id = $answer->answer_id;
                        $userAnswer->question_id = $questionId;
                        if($userAnswer->save()) {
                            mail($user['email'], tt('DCS') - tt('You have new vote').': '.$question->title, $this->createAbsoluteUrl('questions/view', array('id' => $question->question_id)));
                        }
                        $userCount++;
                    }
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