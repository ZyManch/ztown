<?php

use components\Config;

/**
 * This is the model class for table "currencies".
 *
 * The followings are the available columns in table 'currencies':
 * @property integer $id
 * @property string $title
 * @property integer $r
 * @property integer $g
 * @property integer $b
 * @property float $course
 * @property float $default
 * @property Money $userMoney
 * @property string $ext
 * @property string $fixed_value
 * @property string $can_buy
 */
class Currency extends ActiveRecord {

    protected static $lastChanges = array();

    protected static $defaultValute = null;

    protected static $allCurrency = array();

    /**
     * @return string the associated database table name
     */
    public function tableName () {
        return 'currency';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules () {

        return array(
            array('title, course, default', 'required'),
            array('r, g, b, level', 'numerical', 'integerOnly'=> true),
            array('course, default', 'numerical'),
            array('fixed_valute, can_buy', 'length', 'max'=> 3),
            array('type', 'length', 'max'=> 10),
            array('title,ext', 'length', 'max'=> 26),
            array('changed', 'length', 'max' => 20),
            array('status', 'length', 'max' => 7),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations () {
        return array(
            'userMoney' => array(self::HAS_ONE, 'Money', 'currency_id',
                'on' => 'userMoney.user_id=' . (\Yii::$app instanceof CConsoleApplication ? 0 : \Yii::$app->user->getId()))
        );
    }

    /**
     * @return int
     */
    public function lastChange() {
        if (!self::$lastChanges) {
            $dates = \Yii::$app->db->createCommand()->from('courses')->
                select('currency_id, max(changed) as date')->group('currency_id')->queryAll();
            foreach ($dates as $date) {
                self::$lastChanges[$date['currency_id']] = time($date['date']);
            }
        }
        return Config::VALUTA_UPDATE_DELAY
            - \components\Date::timestamp()
            + self::$lastChanges[$this->id];
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
            $crit = new CDbCriteria();
            $crit->with = 'userMoney';
            $crit->index = 'id';
            self::$allCurrency = Currency::model()->findAll($crit);
        }
        if (is_null($id)) {
            return self::$allCurrency;
        } else if(!isset(self::$allCurrency[$id])) {
            return self::$defaultValute;
        } else {
            return self::$allCurrency[$id];
        }
    }

}