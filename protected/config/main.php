<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('web', dirname(__FILE__).'/../..');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'DCS',

	// preloading 'log' component
	'preload'=>array('log','shortcodes'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.helpers.*',
        'application.extensions.*',
		
		'ext.EScriptBoost.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.user.helpers.*',
	),

	'modules'=>array(
		'admin',
        'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',

            # send activation email
            'sendActivationMail' => true,

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,

            # automatically login from registration
            'autoLogin' => true,

            # registration path
            'registrationUrl' => array('/user/registration'),

            # recovery password path
            'recoveryUrl' => array('/user/recovery'),

            # login form path
            'loginUrl' => array('/user/login'),

            # page after login
            'returnUrl' => array('/user/profile'),

            # page after logout
            'returnLogoutUrl' => array('/user/login'),

            'tableUsers'    => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields'    => 'profiles_fields',
        ),
	),

	// application components
	'components'=>array(
		'user'=>array(
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
		),
		'urlManager'=>array(
            'class'=>'DLanguageUrlManager',
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules'=>array(
                '' => 'site/index',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=function.mysql.ukraine.com.ua;dbname=function_dcs',
			'emulatePrepare' => true,
			'username' => 'function_dcs',
			'password' => '4yhvh7y3',
			'charset' => 'utf8',
			'schemaCachingDuration' => !YII_DEBUG ? 86400 : 0,
			'enableParamLogging' => YII_DEBUG,
		),
		'cache' => array(
			'class' => 'CFileCache',
		),
		'assetManager' => array(
			'class' => 'ext.EAssetManagerBoostGz',
			'minifiedExtensionFlags' => array('min.js', 'minified.js', 'packed.js'),
		),
        'bootstrap' => array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'clientScript'=>array(
            'packages' => array(
                'jquery' => array( // jQuery CDN - provided by (mt) Media Temple
                    'baseUrl' => 'http://code.jquery.com/',
                    'js' => array(YII_DEBUG ? 'jquery-1.8.2.js' : 'jquery-1.8.2.min.js'),
                ),
                'jquery.ui' => array( // jQuery CDN - provided by (mt) Media Temple
                    'baseUrl' => 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/',
                    'css' => array('themes/smoothness/jquery-ui.css'),
                    'js' => array(YII_DEBUG ? 'jquery-ui.js' : 'jquery-ui.min.js'),
                    'depends' => array('jquery'),
                ),
                'jquery.cookie' => array(
                    'baseUrl' => '/js',
                    'js' => array('jquery.cookie.js'),
                    'depends' => array('jquery'),
                ),
                'jquery.dynatree' => array(
                    'baseUrl' => '/',
                    'js' => array('js/jquery.dynatree-1.2.4.js'),
                    'css' => array('css/ui.dynatree.css'),
                    'depends' => array('jquery', 'jquery.ui', 'jquery.cookie'),
                ),
                'jquery.bootbox' => array(
                    'baseUrl' => '/js',
                    'js' => array('jquery.bootbox.min.js'),
                    'depends' => array('jquery'),
                ),
                'calendar' => array(
                    'baseUrl' => '/js/fullcalendar',
                    'js' => array('fullcalendar.min.js', 'gcal.js'),
                    'css' => array('fullcalendar.css'),
                    'depends' => array('jquery', 'jquery.ui'),
                ),
                'timepicker' => array(
                    'baseUrl' => '/',
                    'js' => array('js/timepicker.js'),
                    'css' => array('css/timepicker.css', 'css/dfx.min.css'),
                    'depends' => array('jquery', 'jquery.ui'),
                ),
            ),
			'behaviors' => array(
				array(
					'class' => 'ext.behaviors.localscripts.LocalScriptsBehavior',
					'publishJs' => !YII_DEBUG,
					// Uncomment this if your css don't use relative links
					// 'publishCss' => !YII_DEBUG,
				),
			),

		),
        'request'=>array(
            'class'=>'DLanguageHttpRequest',
        ),
        'shortcodes'=>array(
            'class' => 'Shortcodes',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

    'sourceLanguage'=>'en',
    'language'=>'ru',

	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@example.com',
        'translatedLanguages'=>array(
            'ru'=>'Ru',
            'en'=>'En',
            'ua'=>'Ua',
        ),
        'defaultLanguage'=>'ru',

	),
);

// Apply local config modifications
@include dirname(__FILE__) . '/main-local.php';

return $config;
