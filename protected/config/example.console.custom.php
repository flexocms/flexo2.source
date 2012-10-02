<?php

// Example config for console.custom
return array(
	'components'=>array(
		'authManager'=>array(
				'class'=>'CDbAuthManager',
				'connectionID'=>'db',
		),
		'db_test'=>array(
			'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=flexo',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
//			'tablePrefix' => '',
		),
	),
);
