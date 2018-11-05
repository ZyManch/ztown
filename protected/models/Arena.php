<?php

namespace models;

use Yii;

/**
 * This is the model class for table "arena".
 *
 * @property string $arena_id
 * @property string $user_id
 * @property int $level
 * @property string $status
 * @property string $changed
 *
 * @property User $user
 */
class Arena extends base\BaseArena {
}