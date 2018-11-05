<?php
define('HOME', __DIR__.'/');

$configFile = HOME .'protected/config/config.php';
if (!file_exists($configFile)) {
    print 'Config for server '.$serverName.' not available';
    die();
}
$config = include($configFile);
if (php_sapi_name() === "cli") {
    unset($config['components']['errorHandler']);
    unset($config['components']['user']);
    unset($config['components']['session']);
    unset($config['components']['request']);
    $config['controllerNamespace'] = 'commands';
}

defined('YII_DEBUG') or define('YII_DEBUG', $config['params']['debug']);
defined('YII_ENV') or define('YII_ENV', $config['params']['env']);

require(HOME.'vendor/autoload.php');
require(HOME.'vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@web', HOME.'www');
Yii::setAlias('@common', HOME.'protected');
Yii::setAlias('@backend', HOME . 'protected');
Yii::setAlias('@controllers', HOME . 'protected');


$aliases = (is_array($config['aliases']) ? $config['aliases'] : []);
array_walk($aliases, function($path, $alias){
    Yii::setAlias($alias, $path);
});
