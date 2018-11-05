<?php

namespace models;

use Yii;

/**
 * This is the model class for table "money".
 *
 * @property integer $money_id
 * @property integer $user_id
 * @property integer $currency_id
 * @property integer $value
 * @property string $status
 * @property string $changed
 *
 * @property Currency $currency
 * @property User $user
 */
class Money extends base\BaseMoney  {


}