<?php
namespace controllers;

use controllers\base\Controller;
use models\Battle;

class BattlesController extends Controller {


    public $modelClass = Battle::class;

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView ($id) {
        /** @var Battles $battle  */
        $battle = $this->loadModel($id, array('userLeft', 'userRight', 'userstats', 'attacks'));
        if ($battle->hash != Yii::$app->request->getParam('hash')) {
            throw new CHttpException(400, 'Страница не найдена');
        }
        // генерация js
        $userLeftStat = $battle->userLeft->stat;
        $userRightStat = $battle->userRight->stat;
        $maxHpLeft = Yii::$app->config->getHp($userLeftStat->getSumm(2));
        $maxHpRight = Yii::$app->config->getHp($userRightStat->getSumm(2));
        $s = 'window.max_hp = ['.$maxHpLeft.','.$maxHpRight."];\n";
        $s.= 'window.cur_hp = ['.$maxHpLeft.','.$maxHpRight."];\n";
        $arr = array();
        for($i=0, $n=sizeof($battle->attacks);$i<$n;$i+=2) {
            if ($battle->attacks[$i]->from_user_id == $battle->userLeft->id) {
                $leftDamage = (int)$battle->attacks[$i]->power;
                $rightDamage = (int)$battle->attacks[$i+1]->power;
            } else {
                $leftDamage = (int)$battle->attacks[$i+1]->power;
                $rightDamage = (int)$battle->attacks[$i]->power;
            }
            $arr[] = sprintf(
                '[%d,%d]',
                $leftDamage,
                $rightDamage
            );
        }
        $arr[] = '[0,0]';
        Yii::$app->clientScript->registerScript(
            'fight',
            '
            $(".hp_max.left-side").initUser('.$battle->userLeft->id.','.$maxHpLeft.');
            $(".hp_max.right-side").initUser('.$battle->userRight->id.','.$maxHpRight.');
            window.max_hp = ['.$maxHpLeft.','.$maxHpRight.'];
            window.cur_hp = ['.$maxHpLeft.','.$maxHpRight.'];
            window.atacks = ['.implode(',',$arr).'];
            window.pos = '.round(sizeof($battle->attacks)/2).';
            window.interval = setInterval(nextatack, 1000);',
            CClientScript::POS_READY
        );
        return $this->render('view', array('battle'=> $battle));
    }

    public function actionCreate () {
        $model = new Battles;

        if (isset($_POST['Battle'])) {
            $model->attributes = $_POST['Battle'];
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

        if (isset($_POST['Battle'])) {
            $model->attributes = $_POST['Battle'];
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
        $dataProvider = new CActiveDataProvider('Battle');
        return $this->render('index', array(
            'dataProvider'=> $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin () {
        $model = new Battles('search');
        $model->unsetAttributes();
        if (isset($_GET['Battle'])) {
            $model->attributes = $_GET['Battle'];
        }

        return $this->render('admin', array(
            'model'=> $model,
        ));
    }


}
