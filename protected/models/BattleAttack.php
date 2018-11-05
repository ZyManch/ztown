<?php

namespace models;

use Yii;

/**
 * This is the model class for table "battle_attack".
 *
 * @property string $battle_attack_id
 * @property string $battle_id
 * @property string $from_user_id
 * @property string $to_user_id
 * @property string $step
 * @property string $text
 * @property string $power
 * @property string $status
 * @property string $changed
 *
 * @property Battle $battle
 * @property User $fromUser
 * @property User $toUser
 */
class BattleAttack extends base\BaseBattleAttack {
}