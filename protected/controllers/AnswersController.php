<?php

class AnswersController extends Controller
{
    public $defaultAction = 'home';
    public $menuItem = 'main';
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

	public function actionAddComment()
	{
		$answerId = Yii::app()->request->getQuery('answer_id',null);
        $questionId = Answers::model()->findByPk($answerId)->getAttribute('question_id');

        $comment = new Comments;
        $comment->answer_id = $answerId;
        $comment->user_id = Yii::app()->user->id;
        $comment->date_added = new CDbExpression('NOW()');

        if(isset($_POST['Comments']))
        {
            $comment->attributes = $_POST['Comments'];
            $comment->save();
        }

        $this->redirect(Yii::app()->createUrl('questions/view',array('id'=>$questionId)));
	}


}