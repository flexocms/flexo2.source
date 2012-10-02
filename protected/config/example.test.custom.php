<?php

return array(
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=flexo_test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
//			'tablePrefix' => '',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			 'routes'=>array(
				array(
					  'class'=>'CFileLogRoute',
					  'levels'=>'error, warning, trace, info, profile',
					  'logFile'=>'test.log',
				),
			),
		),
	),
);
