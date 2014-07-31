<?php

class QuestionsController extends Controller
{
    public $defaultAction = 'home';
    public $menuItem = 'main';
    public $listItem = '';
    public $layout='//layouts/questions';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionNew()
	{
		$question = new Questions;
        
        $success = false;
        
        if(isset($_POST['Questions'])) {
            $question->attributes = $_POST['Questions'];
            
            //$question->level_id = 1;
            $question->user_id = Yii::app()->user->id;
            $question->date_added = date("Y-m-d H:i:s");            
            
            $users = User::model()->getUserCountByLocation($_POST['Questions']['location_id']);
            $location = Locations::model()->findByPk($_POST['Questions']['location_id']);
            
            $question->level_id = $location->level_id;
            
            if($users > 9)
                $question->iteration_count = strlen($users)-1;
            else
                $question->iteration_count = 1;
            
            $question->location_name = $location->area;
            
            if($question->save()) {
                
                $answer = new Answers;
                $answer->question_id = $question->question_id;
                $answer->iteration_number = 1;
                $answer->date_last_update = date("Y-m-d H:i:s");
                $answer->save();
                
                $users = User::model()->getRandomUsersByLocation($_POST['Questions']['location_id']);
                
                foreach ($users as $user) {
                    $userAnswer = new UsersAnswers;
                    $userAnswer->user_id = $user['id'];
                    $userAnswer->answer_id = $answer->answer_id;
                    $userAnswer->question_id = $question->question_id;
                    if($userAnswer->save()) {
                        /*$mail = new YiiMailer();
                        //$mail->clearLayout();//if layout is already set in config
                        $mail->setFrom('functionw@contact.com', 'Direct COntrol System');
                        $mail->setTo($user['email']);
                        $mail->setSubject('DCS: You have new vote');
                        $mail->setBody('Simple message');
                        $mail->send();*/
                        mail($user['email'], tt('DCS') - ('You have new vote').': '.$question->title, $this->createAbsoluteUrl('questions/view', array('id' => $question->question_id)));
                    }
                }
                
                $this->redirect('list');
            }
        }
        
        $this->render('create', array('data' => $question, 'success' => $success));
	}

    public function actionList()
    {
        $question = new Questions;
        
        if(!Yii::app()->request->isAjaxRequest) {
            $this->listItem = 'new';
            $this->render('list', array('questions' => $question->getQuestions('new')));
        }
        else {
            $this->renderPartial('list', array( 'questions' => $question->getQuestions(str_replace('#', '', $_POST['type']))), false, true);
        }
    }
    
    public function actionView($id)
    {
        if(isset($_GET['voteId'])) {
            $vote = UsersAnswers::model()->findByPk($_GET['voteId']);
            $vote->answer = $_GET['vote'];
            $vote->update();
        }
        $question = Questions::model()->findByPk($id);        

        $data['userAnswer'] = UsersAnswers::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'question_id' => $question->question_id));
        $answerId = $data['userAnswer']->answer_id;
        $data['allAnswer'] = UsersAnswers::model()->getCountOfAnswers($question->question_id);
        $data['question'] = $question;
        
        $this->render('view', array('data' => $data));
    }
}