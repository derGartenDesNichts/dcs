<?php

$mainConfig = include dirname(__FILE__) . '/main.php';

return array(
	'basePath' => $mainConfig['basePath'],
	'name'     => $mainConfig['name'],
	'import'   => $mainConfig['import'],
	
	'preload' => array('log','shortcodes'),

	'components' => array(
		'cache' => $mainConfig['components']['cache'],
		'db'    => $mainConfig['components']['db'],
		'log'   => $mainConfig['components']['log'],
        'shortcodes'  => $mainConfig['components']['shortcodes'],
	),

    'modules' => array(
        'user' => $mainConfig['modules']['user'],
    ),

	'commandMap' => array(
		'migrate' => array(
			'class'        => 'application.commands.ChMigrateCommand',
			'templateFile' => 'application.migrations.template',
		),
	),
	
	'params' => $mainConfig['params'],
);