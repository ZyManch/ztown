<?php

namespace controllers\profile;

use components\Config;
use controllers\base\Controller;
use models\Message;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\filters\AccessControl;

class MessagesController extends Controller
 {



    public $modelClass = Message::class;

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
                        'actions' => ['create','update','outcome'],
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

	public function actionCreate($id) {
		$model=new Messages;
        $model->toUser = $id;
		if(isset($_POST['Messages'])) {
			$model->attributes=$_POST['Messages'];
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

		if(isset($_POST['Messages'])) {
			$model->attributes=$_POST['Messages'];
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
		$dataProvider=new ActiveDataProvider([
		    'query' => Message::find()->
                where(['user_second_id'=>\Yii::$app->user->getIdentity()->user_id])->
                with('firstUser'),
            'sort'     => array(
                'defaultOrder' => array('created' => SORT_DESC),
                'attributes'   => array(
                    'user_first_id',
                    'created',
                    'readed'
                )
            ),
            'pagination' => array(
                'pageSize' => Config::MESSAGES_IN_PAGE
            )
        ]);
		return $this->render('index',array(
            'userKey'      => 'firstUser',
			'dataProvider' => $dataProvider,
		));
	}

    public function actionOutcome() {
        $dataProvider=new ActiveDataProvider([
             'query' => Message::find()->
                 where(['user_second_id'=>\Yii::$app->user->getIdentity()->user_id])->
                 with('secondUser'),
             'sort'     => array(
                 'defaultOrder' => array('created' => SORT_DESC),
                 'attributes'   => array(
                     'user_second_id',
                     'created',
                     'readed'
                 )
             ),
             'pagination' => array(
                 'pageSize' => Config::MESSAGES_IN_PAGE
             )
        ]);
        return $this->render('index',array(
            'userKey'      => 'secondUser',
            'dataProvider' => $dataProvider,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new Messages('search');
		$model->unsetAttributes();
		if(isset($_GET['Messages'])) {
			$model->attributes=$_GET['Messages'];
        }

		return $this->render('admin',array(
			'model'=>$model,
		));
	}


}
