<?php

// include ppma-config
$ppma = include dirname(__FILE__) . '/ppma.php';

// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'     => 'PHP Password Manager',
    'timeZone' => $ppma['timezone'],

    // preloading 'log' component
	'preload' => array('log'),

    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels')
    ),

    // autoloading model and component classes
	'import' => array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*',
        'application.extensions.chromephp.ChromePhp',
        'bootstrap.helpers.TbHtml',
    ),

    // modules
    'modules' => array(
        'gii' => array(
            'class'          => 'system.gii.GiiModule',
            'password'       => 'password',
            //'ipFilters'      => array('127.0.0.1'),
            'generatorPaths' => array(
                'ext.gtc', 'bootstrap.gii',
            ),
        ),
    ),

    // application components
    'components' => array(
        'session' => array(
            'class' => 'HttpSession',
        ),

        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),

        'yiiwheels'=>array(
            'class' => 'yiiwheels.YiiWheels',
        ),

        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js'     => 'js/foundation.min.js',
                'jquery.min.js' => 'js/foundation.min.js',
            ),
        ),

        'db' => array(
            'connectionString' => 'mysql:host=' . $ppma['db']['server'] . ';dbname=' . $ppma['db']['name'],
            'username'         => $ppma['db']['username'],
            'password'         => $ppma['db']['password'],
            'enableProfiling'  => YII_DEBUG,
        ),

        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        'securityManager' => array(
            'class' => 'SecurityManager',
        ),
        
        'settings' => array(
            'class' => 'SettingsComponent',
        ),

        'user' => array(
            'class'          => 'WebUser',
            'loginUrl'       => array('/user/login'),
            'allowAutoLogin' => false,
        ),
    ),

    // application parameters
    'params' => array(
        'adminEmail'  => 'webmaster@example.com',
        'isInstalled' => $ppma['isInstalled'],
        'version'     => $ppma['version'],
        'shortname'   => 'ppma',
    ),
);