<?php

namespace models;

use components\Config;
use components\Date;
use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property string $currency_id
 * @property string $title
 * @property string $ext
 * @property string $color
 * @property string $type
 * @property string $level
 * @property string $default
 * @property string $course
 * @property string $fixed_valute
 * @property string $can_buy
 * @property string $status
 * @property string $changed
 *
 * @property Course[] $courses
 * @property Income[] $incomes
 * @property Money[] $moneys
 * @property Price[] $prices
 * @property UserIncome[] $userIncomes
 */
class Currency extends base\BaseCurrency {

    protected static $lastChanges = array();

    protected static $defaultValute = null;

    protected static $allCurrency = array();


    /**
     * @return int
     */
    public function lastChange() {
        if (!self::$lastChanges) {
            $dates = Course::find()->
                select(['currency_id', 'max(changed) as date'])->
                asArray(true)->
                groupBy('currency_id')->
                all();
            foreach ($dates as $date) {
                self::$lastChanges[$date['currency_id']] = strtotime($date['date']);
            }
        }
        return Config::VALUTA_UPDATE_DELAY
            - Date::timestamp()
            + self::$lastChanges[$this->currency_id];
    }

    public function getPrices() {
        $price = new Price();
        $price->currency_id = Config::VALUTA_ID_DEFAULT;
        $price->value = -$this->course;
        return array($price);
    }

    /**
     * @static
     * @return Currency
     */
    public static function getDefaultValute(){
        if (is_null(self::$defaultValute)) {
            self::$defaultValute = self::getValutes(Config::VALUTA_ID_DEFAULT);
        }
        return self::$defaultValute;
    }

    public static function getValutes($id = null) {
        if (!self::$allCurrency) {
            self::$allCurrency = Currency::find()->indexBy('currency_id')->all();
        }
        if (is_null($id)) {
            return self::$allCurrency;
        }
        if(!isset(self::$allCurrency[$id])) {
            return self::$defaultValute;
        }
        return self::$allCurrency[$id];
    }
}