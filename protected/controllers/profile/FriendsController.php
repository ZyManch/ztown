<?php
namespace controllers\profile;

use components\Config;
use controllers\base\Controller;
use models\Friend;
use models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class FriendsController extends Controller
 {



    public $modelClass = Friend::class;

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
                        'actions' => ['create','update','online'],
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
		$model=new Friends;

		if(isset($_POST['Friends'])) {
			$model->attributes=$_POST['Friends'];
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

		if(isset($_POST['Friends'])) {
			$model->attributes=$_POST['Friends'];
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
		$dataProvider=new ActiveDataProvider(array(
            'query' => Friend::find()->
                where('[[first_user_id]]='.\Yii::$app->user->getIdentity()->user_id)->
                with(['firstUser', 'secondUser']),
            'pagination' => array(
                'pageSize' => Config::FRIENDS_IN_PAGE
            )
        ));
		return $this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionOnline(){
        $dataProvider=new ActiveDataProvider(array(
             'query' => Friend::find()->
                 where('[[first_user_id]]='.\Yii::$app->user->getIdentity()->user_id)->
                 andWhere('user.last_visit > :time',[':time' => time() - User::ONLINE_TIME])->
                 joinWith('firstUser')->
                 with(['firstUser', 'secondUser']),
             'pagination' => array(
                 'pageSize' => Config::FRIENDS_IN_PAGE
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
		$model=new Friends('search');
		$model->unsetAttributes();
		if(isset($_GET['Friends'])) {
			$model->attributes=$_GET['Friends'];
        }

		return $this->render('admin',array(
			'model'=>$model,
		));
	}


}
