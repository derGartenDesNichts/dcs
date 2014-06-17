<?php

class AjaxController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions'=>array('getDistricts'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('conversationwith', 'lastuserslist'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionGetDistricts()
    {
        if(isset($_POST['countryId']) && !empty($_POST['countryId']))
        {
            $countryId = $_POST['countryId'];

            $districts = LocationHelper::getDistricts($countryId);
            echo $districts;
        }

        Yii::app()->end();
    }


}