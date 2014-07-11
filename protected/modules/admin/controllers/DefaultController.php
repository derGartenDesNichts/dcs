<?php

class DefaultController extends AdminController
{
    public function accessRules()
    {
        return array(
            array('deny',  // deny all guests
                'users' => array('?'),
            ),
            array('allow',
                'actions' => array('index'),
                'users'=>UserModule::getAdmins()//array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->render('index');
	}
}