<?php

namespace models;

use behaviors\FriendsBehavior;
use Yii;

/**
 * This is the model class for table "friend".
 *
 * @property string $friend_id
 * @property string $first_user_id
 * @property string $second_user_id
 * @property string $type
 * @property string $is_confirmed
 * @property string $status
 * @property string $changed
 *
 * @property User $firstUser
 * @property User $secondUser
 */
class Friend extends base\BaseFriend {

    const TYPE_FRIEND = 'friend';
    const TYPE_FAMILY = 'family';
    const CONFIRMED_YES = 'yes';
    const CONFIRMED_NO = 'no';

    private $_clone;

    public function behaviors() {
        return array(
            'friends' => array('class' => FriendsBehavior::class)
        );
    }


    /**
     * @return Friend
     */
    public function getClone() {
        if ($this->_clone === null) {
            $this->_clone = self::find()->where([
               'second_user_id' => $this->first_user_id,
               'first_user_id' => $this->second_user_id,
               'type'  => $this->type
           ])->one();
        }
        return $this->_clone;
    }

    /**
     * @return User
     */
    public function getFriend () {
        if ($this->first_user_id == \Yii::$app->user->getId()) {
            return $this->secondUser;
        }
        return $this->firstUser;
    }
}