<?php

class QuestionsController extends Controller
{
    public $defaultAction = 'home';
    public $layout='//layouts/questions';    

	public function actionNew()
	{
		$question = new Questions;
        
        $success = false;
        
        if(isset($_POST['Questions'])) {
            $question->attributes = $_POST['Questions'];
            
            //$question->level_id = 1;
            $question->user_id = Yii::app()->user->id;
            $question->date_added = date("Y-m-d H:i:s");            
            
            $users = User::model()->getUserCountByLocation($_POST['Questions']['level_id']);
            
            if($users > 9)
                $question->iteration_count = strlen($users)-1;
            else
                $question->iteration_count = 1;
            
            if($question->save()) {
                
                $answer = new Answers;
                $answer->question_id = $question->question_id;
                $answer->iteration_number = 1;
                $answer->save();
                
                $users = User::model()->getRandomUsersByLocation($_POST['Questions']['level_id']);
                
                foreach ($users as $user) {
                    $userAnswer = new UsersAnswers;
                    $userAnswer->user_id = $user['id'];
                    $userAnswer->answer_id = $answer->answer_id;
                    $userAnswer->question_id = $question->question_id;
                    $userAnswer->save();
                }
                
                $success = true;
            }
        }
        
        $this->render('create', array('data' => $question, 'success' => $success));
	}

    public function actionList()
    {
        $question = new Questions;
        
        $this->render('list', array('question' => $question));
    }
    
    public function actionView($id)
    {
        $question = Questions::model()->findByPk($id);
        
        $this->render('view', array('data' => $question));
    }
}