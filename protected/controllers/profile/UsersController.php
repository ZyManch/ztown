<?php

namespace controllers\profile;

use components\Html;
use controllers\base\Controller;
use models\User;
use Yii;
use yii\filters\AccessControl;

class UsersController extends Controller
 {



    public $modelClass = User::class;

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
                        'actions' => ['index','view'],
                        'roles'   => ['*'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','profile'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update-info'],
                        'roles'   => ['@'],
                        'verbs'   => ['POST']
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
            'canEdit' => \Yii::$app->user->getIdentity()->isAdmin(),
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate() {
		$model=new User;

		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
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

		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		return $this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionUpdateInfo($id) {
	    /** @var User $user */
	    $user = \Yii::$app->user->getIdentity();
        if (!$user->isAdmin() && $id != $user->user_id) {
            $id = \Yii::$app->user->id;
        }
        $model = $this->loadModel($id);
        if($info = \Yii::$app->request->getBodyParam('info')) {
            $model->info = Html::encode($info);
            if ($model->save()) {
                $this->setUserMessage('Профиль успешно сохранен');
            } else {
                $this->setUserMessage(imlode('. ', $model->getErrors()));
            }
        }
        $this->redirect(
            $id == \Yii::$app->user->id ?
                array('users/profile') :
                array('users/view', 'id' => $id)
        );
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
		$dataProvider=new CActiveDataProvider('User');
		return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$dataProvider = new CActiveDataProvider('User');

		return $this->render('admin',array(
			'dataProvider' => $dataProvider,
		));
	}

    public function actionProfile() {
        return $this->render('view', array(
            'canEdit' => true,
            'model'   => \Yii::$app->user->getIdentity()
        ));
    }
}
