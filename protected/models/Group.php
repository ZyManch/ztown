<?php

namespace models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property string $group_id
 * @property string $name
 * @property string $lower_name
 * @property string $mens
 * @property string $taked
 * @property string $balls
 * @property string $can_take
 * @property string $type
 * @property string $status
 * @property string $changed
 *
 * @property Forum[] $forums
 * @property GroupRequest[] $groupQueries
 * @property MafiaInfo[] $mafiaInfos
 * @property User[] $users
 */
class Group extends base\BaseGroup {

    const MAFIA = 'Mafia';

    public function beforeSave($insert) {
        $this->lower_name = strtolower($this->name);
        return parent::beforeSave($insert);
    }

    public function groupLabel() {
        switch ($this->type) {
            case 'Works':    return 'Фабрика';     break;
            case 'Mafia':    return 'Группировка'; break;
            case 'Bisiness': return 'Корпорация';  break;
        }
    }

    public function inviteLabel() {
        switch ($this->type) {
            case 'Mafia':    return 'Вербовать';           break;
            case 'Works':    return 'Нанять';              break;
            case 'Bisiness': return 'Пригласить работать'; break;
        }
    }

    public function info() {
        switch ($this->type) {
            case 'Mafia': return reset($this->mafiaInfos); break;
        }
    }

    public function isHead() {
        return $this->info()->user_id == \Yii::$app->user->getId();
    }

    public function getInviteInfo($userId) {
        return GroupRequest::find()->where([
            'group_id' => $this->group_id,
            'user_id' => $userId
        ])->one();
    }

}