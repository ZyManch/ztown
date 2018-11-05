<?php

namespace models\base;



/**
 * This is the model class for table "city.money".
 *
 * @property string $money_id
 * @property string $user_id
 * @property string $map_id
 * @property string $currency_id
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property \models\Currency $currency
 * @property \models\Map $map
 * @property \models\User $user
 */
class BaseMoney extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.money';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMoneyPeer::USER_ID, BaseMoneyPeer::CURRENCY_ID, BaseMoneyPeer::VALUE], 'required'],
            [[BaseMoneyPeer::USER_ID, BaseMoneyPeer::MAP_ID, BaseMoneyPeer::CURRENCY_ID, BaseMoneyPeer::VALUE], 'integer'],
            [[BaseMoneyPeer::STATUS], 'string'],
            [[BaseMoneyPeer::CHANGED], 'safe'],
            [[BaseMoneyPeer::CURRENCY_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseCurrency::className(), 'targetAttribute' => [BaseMoneyPeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]],
            [[BaseMoneyPeer::MAP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMap::className(), 'targetAttribute' => [BaseMoneyPeer::MAP_ID => BaseMapPeer::MAP_ID]],
            [[BaseMoneyPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseMoneyPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMoneyPeer::MONEY_ID => 'Money ID',
            BaseMoneyPeer::USER_ID => 'User ID',
            BaseMoneyPeer::MAP_ID => 'Map ID',
            BaseMoneyPeer::CURRENCY_ID => 'Currency ID',
            BaseMoneyPeer::VALUE => 'Value',
            BaseMoneyPeer::STATUS => 'Status',
            BaseMoneyPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\CurrencyQuery
     */
    public function getCurrency() {
        return $this->hasOne(\models\Currency::className(), [BaseCurrencyPeer::CURRENCY_ID => BaseMoneyPeer::CURRENCY_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMap() {
        return $this->hasOne(\models\Map::className(), [BaseMapPeer::MAP_ID => BaseMoneyPeer::MAP_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseMoneyPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\MoneyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MoneyQuery(get_called_class());
    }
}
