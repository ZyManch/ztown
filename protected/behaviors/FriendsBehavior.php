<?php
namespace behaviors;

use models\Friend;
use models\User;
use yii\base\Behavior;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use yii\db\AfterSaveEvent;

/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 20:13
 */
class FriendsBehavior extends Behavior {

    /**
     * {@inheritdoc}
     */
    public function attach($owner)
    {
        $this->owner = $owner;
        $owner->on(ActiveRecord::EVENT_AFTER_INSERT, [$this, 'afterInsert']);
        $owner->on(ActiveRecord::EVENT_AFTER_UPDATE, [$this, 'afterUpdate']);
        $owner->on(ActiveRecord::EVENT_BEFORE_DELETE, [$this, 'beforeDelete']);
    }

    /**
     * {@inheritdoc}
     */
    public function detach()
    {
        if ($this->owner) {
            $this->owner->off(ActiveRecord::EVENT_AFTER_INSERT, [$this, 'afterInsert']);
            $this->owner->off(ActiveRecord::EVENT_AFTER_UPDATE, [$this, 'afterUpdate']);
            $this->owner->off(ActiveRecord::EVENT_BEFORE_DELETE, [$this, 'beforeDelete']);
            $this->owner = null;
        }
    }

    public function afterInsert(AfterSaveEvent $event) {
        /** @var Friend $model  */
        $model = $this->owner;
        if ($model->scenario === 'copy') {
            return true;
        }
        $clone = new Friend();
        $clone->setScenario('copy');
        $clone->first_user_id   = $model->second_user_id;
        $clone->second_user_id   = $model->first_user_id;
        $clone->is_confirmed   = $model->is_confirmed;
        $clone->type   = $model->type;
        $clone->save();
        return true;
    }

    public function afterUpdate(AfterSaveEvent $event) {
        /** @var Friend $model  */
        $model = $this->owner;
        if ($model->scenario === 'copy') {
            return true;
        }

        $clone = $model->getClone();
        if ($clone->is_confirmed !== $model->is_confirmed) {
            $clone->setScenario('copy');
            $clone->is_confirmed = $model->is_confirmed;
            $clone->save();
            if ($model->is_confirmed === Friend::CONFIRMED_YES) {
                self::_clearFamily($model->firstUser);
                self::_clearFamily($model->secondUser);
            }
        }
        return true;
    }

    public function beforeDelete(ModelEvent $event) {
        /** @var Friend $model  */
        $model = $this->owner;
        if ($model->getScenario() === 'copy') {
            return true;
        }
        $model->getClone()->setScenario('copy');
        $model->getClone()->delete();
        return true;
    }

    protected static function _clearFamily(User $user) {
        $families = Friend::find()->where(array(
            'first_user_id' => $user->user_id,
            'type'          => Friend::TYPE_FAMILY,
            'is_confirmed'  => Friend::CONFIRMED_NO
        ))->all();
        foreach ($families as $family) {
            $family->delete();
        }
    }
}