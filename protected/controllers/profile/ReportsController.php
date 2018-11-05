<?php

namespace controllers\profile;

use components\Config;
use controllers\base\Controller;
use models\Report;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class ReportsController extends Controller {


    public $modelClass = Report::class;

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
    public function actionView ($id) {
        return $this->render('view', array(
            'model'=> $this->loadModel($id),
        ));
    }

    public function actionCreate () {
        $model = new Reports;

        if (isset($_POST['Reports'])) {
            $model->attributes = $_POST['Reports'];
            if ($model->save()) {
                $this->redirect(array('view',
                    'id'=> $model->id));
            }
        }

        return $this->render('create', array(
            'model'=> $model,
        ));
    }

    /**
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate ($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Reports'])) {
            $model->attributes = $_POST['Reports'];
            if ($model->save()) {
                $this->redirect(array('view',
                    'id'=> $model->id));
            }
        }

        return $this->render('update', array(
            'model'=> $model,
        ));
    }

    /**
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete ($id) {
        if (Yii::$app->request->isPostRequest) {
            $this->loadModel($id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex () {
        $dataProvider = new ActiveDataProvider(
            [
                'query' => Report::find()->
                    where('user_first_id = :user OR user_second_id = :user',[':user' => \Yii::$app->user->getIdentity()->user_id])->
                    with(['firstUser','secondUser']),
                'sort' => array(
                    'defaultOrder' => array('Date' => SORT_DESC),
                    'attributes'   => array(
                        'title',
                        'user_first_id',
                        'user_second_id',
                        'Date',
                        'Money'
                    )
                ),
                'pagination' => array(
                    'pageSize' => Config::REPORTS_IN_PAGE
                )
            ]
        );
        return $this->render('index', array(
            'dataProvider'=> $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin () {
        $model = new Reports('search');
        $model->unsetAttributes();
        if (isset($_GET['Reports'])) {
            $model->attributes = $_GET['Reports'];
        }

        return $this->render('admin', array(
            'model'=> $model,
        ));
    }


}
