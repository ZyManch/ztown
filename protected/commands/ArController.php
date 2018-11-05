<?php

namespace commands;

use ActiveGenerator\generator\ScriptHelper;
use yii\console\Controller;

class ArController extends Controller
{

    public function actionIndex()
    {

        $helper = new ScriptHelper();
        $helper->baseClass = 'yii\db\ActiveRecord';
        $helper->queryBaseClass = 'yii\db\ActiveQuery';
        $helper->namespace = 'models';
        $helper->prefix = 'Base';
        $helper->sub = 'base';
        $helper->path = \Yii::getAlias('@app/models');
        $helper->generate(
            \Yii::$app->db->masterPdo,
            'city'
        );
    }
}
