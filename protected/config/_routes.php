<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 31.03.2018
 * Time: 18:03
 */
function __getRoutesForDir($base, $dir) {
    $files = scandir($base.'/'.$dir, SCANDIR_SORT_NONE);
    $result = [];
    foreach ($files as $file) {
        if (in_array($file,['.','..'],1)) {
            continue;
        }
        if (is_dir($base.'/'.$dir.'/'.$file)) {
            continue;
        }
        $route = strtolower(preg_replace(
            '/([a-zA-Z])(?=[A-Z])/',
            '$1-',
            substr($file,0,strlen($file)-strlen('Controller.php'))
        ));
        $result[$route] = [
            'class' => '\\'.str_replace('/','\\',$dir.'/'.basename($file,'.php'))
        ];
    }
    return $result;
}
return array_merge(
    ['migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationTable' => '_migration',
        'interactive' => false
    ]],
    __getRoutesForDir(dirname(__DIR__),'controllers'),
    __getRoutesForDir(dirname(__DIR__),'controllers/map'),
    __getRoutesForDir(dirname(__DIR__),'controllers/profile'),
    __getRoutesForDir(dirname(__DIR__),'controllers/wiki')
);


