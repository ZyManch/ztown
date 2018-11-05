<?php

namespace models;

use Yii;

/**
 * This is the model class for table "battle_user".
 *
 * @property string $battle_user_id
 * @property string $battle_id
 * @property string $user_id
 * @property string $stat_id
 * @property string $side
 * @property string $status
 * @property string $changed
 *
 * @property Battle $battle
 * @property Stat $stat
 * @property User $user
 */
class BattleUser extends base\BaseBattleUser {


    public static function getFromUser(User $user, $battleId) {
        $battleUser = new self();
        $stat = new Stat();
        for($i=1; $i<=6; $i++) {
            $stat->setAttribute('stat'.$i, $user->stat->getAttribute('stat' .$i));
            $stat->setAttribute('bonus'.$i, $user->stat->getAttribute('bonus' .$i));
        }
        $stat->save();
        $battleUser->setAttributes(array(
           'user_id'=>$user->user_id,
           'battle_id'=>$battleId,
           'stat_id' => $stat->stat_id
        ));
        return $battleUser;
    }


}