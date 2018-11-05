<?php

namespace controllers;

use controllers\base\Controller;
use models\ItemBuied;
use yii\filters\AccessControl;

class ItemsbuiedController extends Controller
 {



    public $modelClass = ItemBuied::class;

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
                        'actions' => ['create','update','use'],
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

    public function actionUse($id) {
        $model = $this->loadModel($id);
        if ($model->user_id == Yii::$app->user->getId() || Yii::$app->user->isAdmin()) {
            $model->used = 1 - $model->used;
            if (!$model->save()) {
                $this->setUserMessage(implode('. ', $model->getErrors()));
            }
        }
        if ($model->user_id == Yii::$app->user->getId()) {
            $this->redirect('/users/profile');
        } else {
            $this->redirect(array('/users/view', 'id' => $model->user_id));
        }
    }

	public function actionCreate() {
		$model=new ItemBuied;

		if(isset($_POST['ItemBuied'])) {
			$model->attributes=$_POST['ItemBuied'];
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

		if(isset($_POST['ItemBuied'])) {
			$model->attributes=$_POST['ItemBuied'];
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
		$dataProvider=new CActiveDataProvider('ItemBuied');
		return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new ItemBuied('search');
		$model->unsetAttributes();
		if(isset($_GET['ItemBuied'])) {
			$model->attributes=$_GET['ItemBuied'];
        }

		return $this->render('admin',array(
			'model'=>$model,
		));
	}


}
