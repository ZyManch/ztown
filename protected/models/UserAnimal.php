<?php

namespace models;

use Yii;

/**
 * This is the model class for table "user_animal".
 *
 * @property string $user_animal_id
 * @property string $user_id
 * @property string $animal_id
 * @property string $stat_id
 * @property string $level
 * @property string $exp
 * @property string $status
 * @property string $changed
 *
 * @property Animal $animal
 * @property Stat $stat
 * @property User $user
 */
class UserAnimal extends base\BaseUserAnimal {
}