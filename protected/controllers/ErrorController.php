<?php
namespace controllers;

use yii\web\Controller;


/**
 * Site controller
 */
class ErrorController extends Controller
{

    public $layout = 'error';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}
