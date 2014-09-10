<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
    public $menuItem = 'reg';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	/**
	 * Registration user
	 */
	public function actionRegistration() {
        Profile::$regMode = true;
        $model = new RegistrationForm;
        $profile=new Profile;

        // ajax validator
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo UActiveForm::validate(array($model,$profile));
            Yii::app()->end();
        }

        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if(isset($_POST['RegistrationForm'])) {
                //die(var_dump($_POST));
                $model->attributes=$_POST['RegistrationForm'];
                $profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
                $model->username = $model->email;

                if($model->validate()&&$profile->validate())
                {
                    $soucePassword = $model->password;
                    $model->activkey = md5(microtime());
                    $model->password = HashHelper::phpbbHash($model->password);

                    $model->superuser=0;
                    $model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                    if ($model->save(false)) {
                        $profile->user_id=$model->id;
                        $profile->save();

                        if(isset($_POST['UserLocation']) && !empty($_POST['UserLocation']))
                        {
                            $level = 1;
                            foreach($_POST['UserLocation'] as $location)
                            {
                                $locationModel = Locations::model()->findByAttributes(array('level_id'=>$level,'place_id'=>$location));
                                $locationId = $locationModel->location_id;
                                $locModel = new UsersLocations();
                                $locModel->user_id = $model->id;
                                $locModel->location_id = $locationId;
                                $locModel->save();
                                $level++;
                            }
                        }

                        if (Yii::app()->controller->module->sendActivationMail) {

                            $activation_url = Yii::app()->createAbsoluteUrl(
                                '/user/activation/activation',
                                array(
                                    "activkey" => $model->activkey,
                                    "email" => $model->email
                                ));

                            $link = CHtml::link('this link', $activation_url);

                            UserModule::sendMail(
                                $model->email,
                                UserModule::t(
                                    "You registered from {site_name}",
                                    array(
                                        '{site_name}'=>Yii::app()->name
                                    )),
                                UserModule::t(
                                    "Please activate you account. Go to {activation_url}",
                                    array('{activation_url}'=>$link
                                    )
                                )
                            );
                        }

                        if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
                                $identity=new UserIdentity($model->username,$soucePassword);
                                $identity->authenticate();
                                Yii::app()->user->login($identity,0);
                                $this->redirect(Yii::app()->controller->module->returnUrl);
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
                            } elseif(Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                } else $profile->validate();
            }
            $this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
        }
	}
}