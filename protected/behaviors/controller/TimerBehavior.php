<?php
namespace behaviors\controller;

use models\UserIncome;
use yii\base\Behavior;
use yii\web\Controller;
use yii\web\View;

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.03.2018
 * Time: 9:35
 */
class TimerBehavior extends Behavior {



    /**
     * {@inheritdoc}
     */
    public function attach($owner)
    {
        $this->owner = $owner;
        $owner->on(Controller::EVENT_BEFORE_ACTION, [$this, 'beforeAction']);
    }

    /**
     * {@inheritdoc}
     */
    public function detach()
    {
        if ($this->owner) {
            $this->owner->off(Controller::EVENT_BEFORE_ACTION, [$this, 'beforeAction']);
            $this->owner = null;
        }
    }

    public function beforeAction($action) {
        $incomes  = array();
        /** @var \models\User $user */
        $user = \Yii::$app->user->getIdentity();
        if (!$user) {
            return;
        }
        foreach ($user->userIncomes as $income) {
            /** @var UserIncome $income*/
            if (!isset($incomes[$income->currency_id])) {
                $incomes[$income->currency_id] = 0;
            }
            $incomes[$income->currency_id]+=$income->value;
        }
        \Yii::$app->view->registerJs(
            '$(".user_menu span.money").money('.json_encode($incomes).');',
            View::POS_LOAD
        );
    }

}