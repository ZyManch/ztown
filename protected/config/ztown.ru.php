<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'id' => 'ztown',
    'name' => 'ZTown',
    'vendorPath' => HOME . 'vendor',
    'basePath' => HOME.'protected',
    'timeZone' => 'Europe/Moscow',
    'controllerNamespace' => 'controllers',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => '_migration',
            'interactive' => false
        ],
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=city',
            'username' => 'develop',
            'password' => 'develop@box',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => 'f1n861g104fvf-p13f1fv1cv19731c13-[mt',
        ],
        'user' => [
            'identityClass' => 'models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['login/index']
        ],
        'session' => [
            'name' => 'SESSID',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'hashCallback' => function($path){
                $path = (is_file($path) ? dirname($path) : $path);

                return sprintf('%x', crc32($path . Yii::getVersion()));
            }
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            'driver'=>'GD',
            'params'=>array('directory'=> dirname(__FILE__) . '/../cache/image'),
        ),
    ],
    'params'         => array(
        'debug'     => true,
        'adminEmail'=> 'zymanch@gmail.com',
        'analytics'=>'UA-38561290-1',
        'clients' => array(
            'vkontakte' => array('client_id' => 123, 'client_code' => '123'),
            'twitter'   => array('client_id' => 'Y1HZi9DQrZUkRFyjdl9JbQ', 'client_code' => 'XZqez5tU4duwKNeE9cmCwgeSqJc7hua2wrgOsOW5Ec'),
            'facebook'   => array('client_id' => '624769797546626', 'client_code' => '54255a05711f27ad39ea8e75491bd982')
        )
    ),
);