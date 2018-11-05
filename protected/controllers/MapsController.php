<?php

namespace controllers;

use components\GlobalMap;
use models\Map;
use models\MapType;
use models\User;
use Yii;
use controllers\base\Controller;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\View;

class MapsController extends Controller
 {



    public $modelClass = Map::class;

	/**
	 * @return array access control rules
	 */
    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view','load'],
                        'roles'   => ['*'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['admin','delete','update'],
                        'roles'   => ['admin'],
                    ]
                ]
            ]
        ]);
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)	{
		return $this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate() {
		$model=new Map;

		if(isset($_POST['Map'])) {
			$model->attributes=$_POST['Map'];
			if($model->save()) {
                $this->redirect(array('view','id'=>$model->id));
            }
		}

		return $this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($type, $x, $y) {
		$model=Map::findByXY($x, $y);
        if ($model) {
            $model->map_type_id = $type;
            if (!$model->save()) {
                print 'alert("'.addslashes(implode('. ', array_map('array_shift', $model->getErrors()))).'");';
            }
        }
	}

	/**
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		if(Yii::$app->request->isPostRequest) {
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
		} else {
			throw new HttpException(400,'Invalid request. Please do not repeat this request again.');
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
		return $this->render('index', array(
		    'mapSize'   => GlobalMap::MAP_VIEW_SIZE,
            'centerX'   => $user->x,
            'centerY'   => $user->y
        ));
	}

    public function actionLoad($x, $y, $center_x = null, $center_y = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        if ($center_x !== null && $center_y !== null) {
            $user->x = (int)$center_x;
            $user->y = (int)$center_y;
            $user->save();
        }
        $globalMap = new GlobalMap();
        return ['maps' => $globalMap->getMap($x, $y)];
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
        $centerX = Yii::$app->request->get('x', Yii::$app->user->getIdentity()->x);
        $centerY = Yii::$app->request->get('y', Yii::$app->user->getIdentity()->y);
        $map = Map::getMap($centerX, $centerY);
        $this->view->registerJs('
            var start_x = ' . ($centerX - Map::MAP_VIEW_SIZE) .';
            var start_y = ' . ($centerY  - Map::MAP_VIEW_SIZE) .';
            var map_array = ' . json_encode($map) . ';
        ', View::POS_HEAD);
        Yii::$app->view->registerJs('
            $(document).ready(function(){
                $(".moved td").click(drag_map);
            });
        ');

		return $this->render('admin', array(
            'map'       => $map,
            'centerX'   => $centerX,
            'centerY'   => $centerY,
            'mapTypes' => array(
                'natures'   => $this->getTiles('nature'),
                'roads'   => $this->getTiles('road'),
                'surfaces'   => $this->getTiles('surface'),
                'houses'    => $this->getTiles('house')
            )
		));
	}

    protected function getTiles($type){
        return MapType::find()->where('type=:type',[':type' => $type])->orderBy('name ASC')->all();
    }
}
