<?php
namespace controllers;

use controllers\base\Controller;
use models\MapType;
use yii\filters\AccessControl;

class MapTypeController extends Controller
 {



    public $modelClass = MapType::class;

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view','tiles'],
                        'roles'   => ['*'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','update','admin'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles'   => ['admin'],
                    ]
                ]
            ]
        ]);
    }

    public function actionTiles() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $tiles = MapType::find()->all();
        $result = [];
        /** @var MapType $tile */
        foreach ($tiles as $tile) {
            $normal = $tile->image();
            $size = $tile->size();
            $result[$tile->map_type_id] = [
                'map_type_id' => $tile->map_type_id,
                'title'       => $tile->name,
                'description' => $tile->info,
                'controller'  => $tile->controller,
                'image'       => str_replace('images/','',$normal),
                'width'       => $size[0],
                'height'      => $size[1],
            ];
        }
        return ['tiles' => $result];
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
		$model=new MapType;

		if(isset($_POST['MapType'])) {
			$model->attributes=$_POST['MapType'];
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
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		if(isset($_POST['MapType'])) {
			$model->attributes=$_POST['MapType'];
			if(!$model->save()) {
				$this->setUserMessage($this->extractErrors($model));
            }
		}
        $this->redirect(array('mapType/admin'));
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider=new CActiveDataProvider('MapType', array(
            'criteria' => array(
                'order' => 'id ASC'
            ),
            'pagination' => array(
                'pageSize' => 1000
            )
        ));
		return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
        $dataProvider=new CActiveDataProvider('MapType', array(
            'criteria' => array(
                'order' => 'id ASC'
            ),
            'pagination' => array(
                'pageSize' => 1000
            )
        ));
		return $this->render('admin', array(
			'dataProvider' => $dataProvider,
		));
	}


}
