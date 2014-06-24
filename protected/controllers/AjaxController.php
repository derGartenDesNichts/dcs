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
                'actions'=>array('getDistricts','getCities'),
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

    public function actionGetCities()
    {
        if(isset($_POST['districtId']) && !empty($_POST['districtId']))
        {
            $districtId = $_POST['districtId'];

            $cities = LocationHelper::getCities(null,$districtId);
            echo $cities;
        }

        Yii::app()->end();
    }


}