<?php

namespace models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property string $house_id
 * @property string $map_id
 * @property string $user_id
 * @property string $last_pay
 * @property string $status
 * @property string $changed
 *
 * @property Map $map
 * @property User $user
 */
class House extends base\BaseHouse {
}