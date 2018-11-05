<?php

namespace models;

use Yii;

/**
 * This is the model class for table "battle_army".
 *
 * @property string $battle_army_id
 * @property string $parent_id
 * @property string $battle_id
 * @property string $stat
 * @property string $name
 * @property string $status
 * @property string $changed
 *
 * @property Battle $battle
 */
class BattleArmy extends base\BaseBattleArmy {
}