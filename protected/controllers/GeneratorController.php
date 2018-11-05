<?php
namespace controllers;

use controllers\base\Controller;
use models\Map;
use yii\filters\AccessControl;

class GeneratorController extends Controller {



    public $modelClass = Map::class;

    /**
     * @return array
     */
    public function filters() {
        return array(
            'accessControl'
        );
    }

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [

                    [
                        'allow' => true,
                        'actions' => ['css'],
                        'roles'   => ['@'],
                    ]
                ]
            ]
        ]);
    }


    /**
     * Lists all models.
     */
    public function actionCss() {

        $mapTypes = MapType::model()->findAll(array('order' => 'ID ASC'));
        $css = $this->renderPartial('css', array(
            'mapTypes' => $mapTypes,
        ),true);
        file_put_contents('css/tiles.css', $css);
        print 'done';
    }


}
