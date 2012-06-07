<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'p2k.cc',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yiidebugtb.*', //our extension
		//'application.extensions.bootstrap.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'bootstrap.gii'
			),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bootstrap'=>array(
			'class'	=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
			'coreCss'	=>true, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
			'responsiveCss'	=>false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
			'plugins'	=>array(
				// Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
				// To prevent a plugin from being loaded set it to false as demonstrated below
				'transition'=>false, // disable CSS transitions
				'tooltip'=>array(
					'selector'=>'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
					'options'=>array(
						'placement'=>'bottom', // place the tooltips below instead
					),
				),
			),
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'/',
			'rules'=>array(
				'' => 'site/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		* 
		*/

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=p2k',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		/*
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				// configuration for the toolbar
				array(
					'class'=>'XWebDebugRouter',
					'config'=>'alignLeft, opaque, runInDebug, fixedPos,  yamlStyle',
					'levels'=>'error, warning, trace, profile, info',
					'allowedIPs'=>array('127.0.0.1'),
				),
				array(

					'class'=>'CFileLogRoute',
					'levels'=>'profile',
					'logFile'=>'profile.log',
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