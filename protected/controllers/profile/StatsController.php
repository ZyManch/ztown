<?php

namespace controllers\profile;

use controllers\base\Controller;
use models\Stat;

class StatsController extends Controller {

    public $layout = 'column2';

    public $modelClass = Stat::class;

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
        $model = new Stat;

        if (isset($_POST['Stat'])) {
            $model->attributes = $_POST['Stat'];
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

        if (isset($_POST['Stat'])) {
            $model->attributes = $_POST['Stat'];
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
        $dataProvider = new CActiveDataProvider('Stat');
        return $this->render('index', array(
            'dataProvider'=> $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin () {
        $model = new Stat('search');
        $model->unsetAttributes();
        if (isset($_GET['Stat'])) {
            $model->attributes = $_GET['Stat'];
        }

        return $this->render('admin', array(
            'model'=> $model,
        ));
    }


}
