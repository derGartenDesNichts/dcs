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
            
            $question->level_id = 1;
            $question->user_id = Yii::app()->user->id;
            $question->date_added = date("Y-m-d H:i:s");
            $question->iteration_count = 1;
            
            $users = User::model()->getUserCountByLevel(1);
            die(var_dump($users));
            if($question->save())
                $success = true;
        }
        
        $this->render('create', array('data' => $question, 'success' => $success));
	}

    public function actionList()
    {
        $question = new Questions;

        $this->render('list', array('data' => $question->getNewQuestions()));
    }
}