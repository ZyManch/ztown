<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 02.02.13
 * Time: 6:56
 */
$github_ips = array('207.97.227.253','50.57.128.197','108.171.174.178','50.57.231.61');

if(in_array($_SERVER['REMOTE_ADDR'], $github_ips)) {
    $dir = '/var/www/zymanch/data/www/ztown.ru';
    exec("cd $dir && git pull");
    echo 'Done.';
} else {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found.';
    exit;
}