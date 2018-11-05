<?php

namespace models\base;



/**
 * This is the model class for table "city.income".
 *
 * @property string $income_id
 * @property string $source_type
 * @property string $source_id
 * @property string $map_type_id
 * @property string $currency_id
 * @property string $income_type
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property \models\Currency $currency
 * @property \models\MapType $mapType
 */
class BaseIncome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseIncomePeer::SOURCE_TYPE, BaseIncomePeer::SOURCE_ID, BaseIncomePeer::MAP_TYPE_ID, BaseIncomePeer::CURRENCY_ID, BaseIncomePeer::INCOME_TYPE, BaseIncomePeer::VALUE], 'required'],
            [[BaseIncomePeer::SOURCE_ID, BaseIncomePeer::MAP_TYPE_ID, BaseIncomePeer::CURRENCY_ID, BaseIncomePeer::VALUE], 'integer'],
            [[BaseIncomePeer::STATUS], 'string'],
            [[BaseIncomePeer::CHANGED], 'safe'],
            [[BaseIncomePeer::SOURCE_TYPE], 'string', 'max' => 6],
            [[BaseIncomePeer::INCOME_TYPE], 'string', 'max' => 8],
            [[BaseIncomePeer::CURRENCY_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseCurrency::className(), 'targetAttribute' => [BaseIncomePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]],
            [[BaseIncomePeer::MAP_TYPE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMapType::className(), 'targetAttribute' => [BaseIncomePeer::MAP_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseIncomePeer::INCOME_ID => 'Income ID',
            BaseIncomePeer::SOURCE_TYPE => 'Source Type',
            BaseIncomePeer::SOURCE_ID => 'Source ID',
            BaseIncomePeer::MAP_TYPE_ID => 'Map Type ID',
            BaseIncomePeer::CURRENCY_ID => 'Currency ID',
            BaseIncomePeer::INCOME_TYPE => 'Income Type',
            BaseIncomePeer::VALUE => 'Value',
            BaseIncomePeer::STATUS => 'Status',
            BaseIncomePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\CurrencyQuery
     */
    public function getCurrency() {
        return $this->hasOne(\models\Currency::className(), [BaseCurrencyPeer::CURRENCY_ID => BaseIncomePeer::CURRENCY_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getMapType() {
        return $this->hasOne(\models\MapType::className(), [BaseMapTypePeer::MAP_TYPE_ID => BaseIncomePeer::MAP_TYPE_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\IncomeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\IncomeQuery(get_called_class());
    }
}
