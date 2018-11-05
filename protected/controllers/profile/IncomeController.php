<?php
namespace controllers\profile;

use components\Config;
use components\Date;
use controllers\base\Controller;
use models\UserIncome;
use yii\filters\AccessControl;


class IncomeController extends Controller {



    public $modelClass = UserIncome::class;

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
                        'actions' => ['create','update','stats'],
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


    public function actionStats() {
        $date = explode(':', date('H:i:s', Date::timestamp()));
        $curSeconds = $date[0] * 3600 + $date[1] * 60 + $date[2];
        $allIncoms = UserIncome::find()->
            where(['user_id' => \Yii::$app->user->getIdentity()->user_id])->
            orderBy('time desc')->
            all();
        $incomeBefore = array();
        $incomeAfter = array();
        foreach ($allIncoms as $income) {
            if ($income->Time > $curSeconds) {
                $incomeBefore[] = $income;
            } else {
                $incomeAfter[] = $income;
            }
        }
        $incomes = array_merge(
            $incomeBefore,
            $incomeAfter
        );
        return $this->render('stats', array(
            'incomes' => $incomes,
        ));
    }

	public function actionCreate() {
		$model=new UserIncome;

		if(isset($_POST['UserIncome'])) {
			$model->attributes=$_POST['UserIncome'];
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

		if(isset($_POST['UserIncome'])) {
			$model->attributes=$_POST['UserIncome'];
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
		$dataProvider=new CActiveDataProvider('UserIncome');
		return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new UserIncome('search');
		$model->unsetAttributes();
		if(isset($_GET['UserIncome'])) {
			$model->attributes=$_GET['UserIncome'];
        }

		return $this->render('admin',array(
			'model'=>$model,
		));
	}


}
