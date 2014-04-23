<?php

class QuestionsController extends Controller
{
    public $defaultAction = 'home';
    public $layout='//layouts/questions';


	public function actionCreate()
	{
		$question = new Questions;

        $this->render('create', array('data' => $question));
	}

    public function actionList()
    {
        $question = new Questions;

        $this->render('list', array('data' => $question->getNewQuestions()));
    }
}