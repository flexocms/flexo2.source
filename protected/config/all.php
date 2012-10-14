<?php

return CMap::mergeArray(
	array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'Flexo Application',
		'sourceLanguage' => 'en_us',
		'language' => 'ru',

		// preloading 'log' component
		'preload'=>array(
            'log',
            'bootstrap',
        ),

		// autoloading model and component classes
		'import'=>array(
			'application.models.*',
			'application.components.*',
            'application.models.forms.*',
		),

		'modules'=>array(
            'gii'=>array(
                'generatorPaths'=>array(
                    'bootstrap.gii',
                ),
            ),
		),

		// application components
		'components'=>array(

            'bootstrap'=>array(
                'class'=>'ext.bootstrap.components.Bootstrap',
            ),

			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
			),

//			'authManager'=>array(
//                              'class'=>'CDbAuthManager',
//                              'authFile' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'auth.php',
//			),

			'request'=>array(
				'enableCookieValidation'=>true,
			),

			'assetManager'=>array(
				'linkAssets' => true,
			),

			'urlManager'=>array(
				'urlFormat'=>'get',
				'showScriptName'=>false,
				'urlSuffix'=>'/',
				'rules'=>array(
					// When you add some rule for here - add same one to Post::$aDisabledTitle
					'/' => 'post/index',
					'post/<action:create|admin>'=>'post/<action>',
					'post/<action:update|delete>/<id:\d+>'=>'post/<action>',
					'post/<id:\d+>'=>'post/view',
					'post/<url:[^\/]+>'=>'post/view',
					'find'=>'post/find',
					'posts/page/<page:\d+>'=>'post/index',
					'posts(/<tag:.*?>)?'=>'post/index',
					'tag/<tag:.*?>'=>'post/index',

					'<view:about>' => 'site/page',
					'<action:(login|logout)>' => 'site/<action>',

					'sitemap\.xml' => 'post/sitemap',
					'gii' => 'gii',
					'rss' => 'rss/index',
					'<id:\d+>'=>'post/view',
					'<url:[^\/]+>' => 'post/view',
					'<url:[^\/]+>/rss' => 'rss/post',
				),
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

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			'cacheTime' => 3600,
			'adminEmail'=>'webmaster@example.com',
		),
	),
	require(dirname(__FILE__).'/all.custom.php')
);
