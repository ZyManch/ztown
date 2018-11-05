<?php

namespace models;

use Yii;

/**
 * This is the model class for table "mafia_info".
 *
 * @property string $mafia_info_id
 * @property string $group_id
 * @property string $map_id
 * @property string $user_id
 * @property string $status
 * @property string $changed
 *
 * @property Group $group
 * @property Map $map
 * @property User $user
 */
class MafiaInfo extends base\BaseMafiaInfo {
}