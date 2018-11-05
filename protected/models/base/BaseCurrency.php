<?php

namespace models\base;



/**
 * This is the model class for table "city.currency".
 *
 * @property string $currency_id
 * @property string $title
 * @property string $ext
 * @property string $color
 * @property string $type
 * @property string $level
 * @property string $default_course
 * @property string $course
 * @property integer $weight
 * @property string $fixed_valute
 * @property string $can_buy
 * @property string $status
 * @property string $changed
 *
 * @property \models\Course[] $courses
 * @property \models\Income[] $incomes
 * @property \models\Money[] $moneys
 * @property \models\PriceValue[] $priceValues
 * @property \models\UserIncome[] $userIncomes
 */
class BaseCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseCurrencyPeer::TITLE, BaseCurrencyPeer::EXT, BaseCurrencyPeer::COLOR, BaseCurrencyPeer::TYPE, BaseCurrencyPeer::LEVEL, BaseCurrencyPeer::DEFAULT_COURSE, BaseCurrencyPeer::COURSE], 'required'],
            [[BaseCurrencyPeer::LEVEL, BaseCurrencyPeer::DEFAULT_COURSE, BaseCurrencyPeer::WEIGHT], 'integer'],
            [[BaseCurrencyPeer::COURSE], 'number'],
            [[BaseCurrencyPeer::FIXED_VALUTE, BaseCurrencyPeer::CAN_BUY, BaseCurrencyPeer::STATUS], 'string'],
            [[BaseCurrencyPeer::CHANGED], 'safe'],
            [[BaseCurrencyPeer::TITLE], 'string', 'max' => 32],
            [[BaseCurrencyPeer::EXT], 'string', 'max' => 16],
            [[BaseCurrencyPeer::COLOR], 'string', 'max' => 6],
            [[BaseCurrencyPeer::TYPE], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseCurrencyPeer::CURRENCY_ID => 'Currency ID',
            BaseCurrencyPeer::TITLE => 'Title',
            BaseCurrencyPeer::EXT => 'Ext',
            BaseCurrencyPeer::COLOR => 'Color',
            BaseCurrencyPeer::TYPE => 'Type',
            BaseCurrencyPeer::LEVEL => 'Level',
            BaseCurrencyPeer::DEFAULT_COURSE => 'Default Course',
            BaseCurrencyPeer::COURSE => 'Course',
            BaseCurrencyPeer::WEIGHT => 'Weight',
            BaseCurrencyPeer::FIXED_VALUTE => 'Fixed Valute',
            BaseCurrencyPeer::CAN_BUY => 'Can Buy',
            BaseCurrencyPeer::STATUS => 'Status',
            BaseCurrencyPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\CourseQuery
     */
    public function getCourses() {
        return $this->hasMany(\models\Course::className(), [BaseCoursePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]);
    }
        /**
     * @return \models\IncomeQuery
     */
    public function getIncomes() {
        return $this->hasMany(\models\Income::className(), [BaseIncomePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]);
    }
        /**
     * @return \models\MoneyQuery
     */
    public function getMoneys() {
        return $this->hasMany(\models\Money::className(), [BaseMoneyPeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]);
    }
        /**
     * @return \models\PriceValueQuery
     */
    public function getPriceValues() {
        return $this->hasMany(\models\PriceValue::className(), [BasePriceValuePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]);
    }
        /**
     * @return \models\UserIncomeQuery
     */
    public function getUserIncomes() {
        return $this->hasMany(\models\UserIncome::className(), [BaseUserIncomePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\CurrencyQuery(get_called_class());
    }
}
