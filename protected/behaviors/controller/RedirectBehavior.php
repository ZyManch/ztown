<?php
namespace behaviors\controller;

use components\Date;
use models\UserViewPage;
use yii\base\Behavior;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.03.2018
 * Time: 9:35
 */
class RedirectBehavior extends Behavior {



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
        /** @var \models\User $user */
        $user = \Yii::$app->user->getIdentity();
        if (!$user) {
            return;
        }
        $user->last_visit = Date::db();
        $user->save();

        foreach ($user->userViewPages as $viewPage) {
            /** @var $viewPage UserViewPage */
            switch ($viewPage->count) {
                case UserViewPage::COUNT_ALWAYS:
                    if ($viewPage->isCurrentUrl()) {
                        break;
                    }
                    $viewPage->redirect();
                    break;
                case UserViewPage::COUNT_ONE:
                    if ($viewPage->isCurrentUrl()) {
                        break;
                    }
                    $viewPage->delete();
                    $viewPage->redirect();
                    break;
                case UserViewPage::COUNT_NEVER:
                    if ($viewPage->isCurrentUrl()) {
                        throw new HttpException(403, \Yii::t('yii','You are not authorized to perform this action.'));
                    }
                    break;
            }
        }
    }

}