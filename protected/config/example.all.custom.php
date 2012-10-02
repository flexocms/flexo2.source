<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	// application components
	'components'=>array(

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=flexo',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
//			'tablePrefix' => '',
			//TODO: в продакешене поставить
//			'schemaCachingDuration'=>0,
//			'enableProfiling'=>true,
//			'enableParamLogging' => true,
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					//'levels'=>'error, warning, trace, info, profile',
					'levels'=>'error, warning, info, profile',
					'logFile'=>'my.log',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
