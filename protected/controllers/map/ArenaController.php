<?php
namespace controllers\map;

use controllers\base\EventController;
use models\Arena;

class ArenaController extends EventController {
    public $modelClass = Arena::class;
    public $mapTypeId = 1;

    /**
     * @var bool прошел ли делей межде боями
     */
    public $disabledArena = false;

    /**
     * @var Arena
     */
    public $arena;

    public function beforeAction($action) {
        $lastBattle = $this->user->getLastBattle();
        $this->disabledArena = $lastBattle && $lastBattle->changed() >
            Yii::$app->config->curTime() - Config::ARENA_DELAY;
        $this->arena = Arena::model()->findByAttributes(
            array('user_id' => $this->user->id)
        );
        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function getPages() {
        return [
            'Арена' => 'arena',
        ];
    }
	/**
     * @return void
	 */
	public function actionArena() {
        if ($this->arena) {
            return $this->render('wait', array(
                'disabled' => $this->disabledArena
            ));
        }
        return $this->render('view', array(
            'disabled' => $this->disabledArena
        ));
	}

    public function actionFight() {
        if ($this->arena) {
            $this->redirect(array('view'));
        }
        $crit = new CDbCriteria();
        $crit->compare('lvl', $this->user->level);
        $crit->order = 'changed ASC';
        /** @var Arena $opponent  */
        $opponent = Arena::model()->find($crit);
        if ($opponent) {
            $battle = new Battles();
            $battlePrizeMoney = new BattlePrize();
            $battlePrizeMoney->setAttributes(array(
               'prize_type' => BattlePrize::PRIZE_TYPE_MONEY,
               'prize_id' => Config::VALUTA_ID_DEFAULT,
               'value' => Yii::$app->config->getSingleWinPrice(
                   ($opponent->lvl + $this->user->level)/2
               )
            ));
            $battle->fight(
                $opponent->user,
                $this->user,
                array(
                     BattlePrize::create(array(
                         'prize_type' => BattlePrize::PRIZE_TYPE_MONEY,
                         'prize_id' => Config::VALUTA_ID_DEFAULT,
                         'value' => Yii::$app->config->getSingleWinPrice(
                             ($opponent->lvl + $this->user->level)/2
                         )
                     )),
                     BattlePrize::create(array(
                          'prize_type' => BattlePrize::PRIZE_TYPE_EXP,
                          'value' => Yii::$app->config->getSingleWinPrice(
                              ($opponent->lvl + $this->user->level)/2
                          )
                     ))
                )
            );
            $opponent->delete();
        } else {
            $arena = new Arena();
            $arena->setAttributes(array(
                'user_id' => $this->user->id,
                'lvl'     => $this->user->level
            ));
            $arena->save();
        }
        $this->redirect(array('arena'));
    }

    public function actionStop() {
        if ($this->arena && !$this->disabledArena) {
            $this->arena->delete();
        }
        $this->redirect(array('arena'));
    }

	public function actionCreate() {
		$model=new Arena;

		if(isset($_POST['Arena'])) {
			$model->attributes=$_POST['Arena'];
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

		if(isset($_POST['Arena'])) {
			$model->attributes=$_POST['Arena'];
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
		$dataProvider=new CActiveDataProvider('Arena');
        return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new Arena('search');
		$model->unsetAttributes();
		if(isset($_GET['Arena'])) {
			$model->attributes=$_GET['Arena'];
        }

        return $this->render('admin',array(
			'model'=>$model,
		));
	}


}
