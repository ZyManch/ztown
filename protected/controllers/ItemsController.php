<?php

namespace controllers;

use controllers\base\Controller;
use models\Item;
use yii\filters\AccessControl;

class ItemController extends Controller
 {



    public $modelClass = Item::class;

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles'   => ['*'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','update'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['admin','delete'],
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
		$model=new Items;

		if(isset($_POST['Item'])) {
			$model->attributes=$_POST['Item'];
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

		if(isset($_POST['Item'])) {
			$model->attributes=$_POST['Item'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		return $this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Item');
		return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new Items('search');
		$model->unsetAttributes();
		if(isset($_GET['Item'])) {
			$model->attributes=$_GET['Item'];
        }

		return $this->render('admin',array(
			'model'=>$model,
		));
	}


}
