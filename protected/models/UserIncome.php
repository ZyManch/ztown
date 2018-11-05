<?php

namespace models;

use components\Config;
use components\Date;
use Yii;

/**
 * This is the model class for table "user_income".
 *
 * @property string $user_income_id
 * @property string $user_id
 * @property string $currency_id
 * @property string $source_type
 * @property string $source_id
 * @property string $income_type
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property Currency $currency
 * @property User $user
 */
class UserIncome extends base\BaseUserIncome {


    public function getMoney() {
        $timestamp = strtotime($this->changed);
        return round (
            $this->value *
            (Date::timestamp() - Date::timestamp($timestamp)) /
            3600
        );
    }


    public function getSecondsToUserIncome() {
        $date = explode(':', date('H:i:s', Date::timestamp()));
        $seconds = strtotime($this->changed) - $date[0]*3600 - $date[1]*60-$date[2];
        if ($seconds < 0) {
            $seconds += 86400;
        }
        return $seconds;
    }

    public static function getSeconds($time=null) {
        if (is_null($time)) {
            $time = Date::timestamp();
        }
        $date = explode(':', date('H:i:s', $time));
        return $seconds = $date[0]*3600 + $date[1]*60 + $date[2];
    }


}