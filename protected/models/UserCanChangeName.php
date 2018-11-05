<?php

namespace models;

use Yii;

/**
 * This is the model class for table "user_can_change_name".
 *
 * @property string $user_can_change_name_id
 * @property string $user_id
 * @property string $expires
 * @property string $status
 * @property string $changed
 *
 * @property User $user
 */
class UserCanChangeName extends base\BaseUserCanChangeName {
}