<?php

namespace models\base;



/**
 * This is the model class for table "city.price_value".
 *
 * @property string $price_value_id
 * @property string $price_id
 * @property string $currency_id
 * @property integer $value
 * @property string $status
 * @property string $changed
 *
 * @property \models\Currency $currency
 * @property \models\Price $price
 */
class BasePriceValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.price_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BasePriceValuePeer::PRICE_ID, BasePriceValuePeer::CURRENCY_ID, BasePriceValuePeer::VALUE], 'required'],
            [[BasePriceValuePeer::PRICE_ID, BasePriceValuePeer::CURRENCY_ID, BasePriceValuePeer::VALUE], 'integer'],
            [[BasePriceValuePeer::STATUS], 'string'],
            [[BasePriceValuePeer::CHANGED], 'safe'],
            [[BasePriceValuePeer::CURRENCY_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseCurrency::className(), 'targetAttribute' => [BasePriceValuePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]],
            [[BasePriceValuePeer::PRICE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BasePrice::className(), 'targetAttribute' => [BasePriceValuePeer::PRICE_ID => BasePricePeer::PRICE_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BasePriceValuePeer::PRICE_VALUE_ID => 'Price Value ID',
            BasePriceValuePeer::PRICE_ID => 'Price ID',
            BasePriceValuePeer::CURRENCY_ID => 'Currency ID',
            BasePriceValuePeer::VALUE => 'Value',
            BasePriceValuePeer::STATUS => 'Status',
            BasePriceValuePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\CurrencyQuery
     */
    public function getCurrency() {
        return $this->hasOne(\models\Currency::className(), [BaseCurrencyPeer::CURRENCY_ID => BasePriceValuePeer::CURRENCY_ID]);
    }
        /**
     * @return \models\PriceQuery
     */
    public function getPrice() {
        return $this->hasOne(\models\Price::className(), [BasePricePeer::PRICE_ID => BasePriceValuePeer::PRICE_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\PriceValueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\PriceValueQuery(get_called_class());
    }
}
