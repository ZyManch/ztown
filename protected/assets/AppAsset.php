<?php

namespace assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $jsOptions = [
        'position' => View::POS_END
    ];
    public $baseUrl = '@web';
    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/animations.js',
        'js/jquery.money.js',
        'js/timer.js',

    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}