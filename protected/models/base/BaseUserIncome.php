<?php

namespace models\base;



/**
 * This is the model class for table "city.user_income".
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
 * @property \models\Currency $currency
 * @property \models\User $user
 */
class BaseUserIncome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.user_income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseUserIncomePeer::USER_ID, BaseUserIncomePeer::CURRENCY_ID, BaseUserIncomePeer::SOURCE_ID, BaseUserIncomePeer::VALUE], 'integer'],
            [[BaseUserIncomePeer::STATUS], 'string'],
            [[BaseUserIncomePeer::CHANGED], 'safe'],
            [[BaseUserIncomePeer::SOURCE_TYPE], 'string', 'max' => 10],
            [[BaseUserIncomePeer::INCOME_TYPE], 'string', 'max' => 9],
            [[BaseUserIncomePeer::CURRENCY_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseCurrency::className(), 'targetAttribute' => [BaseUserIncomePeer::CURRENCY_ID => BaseCurrencyPeer::CURRENCY_ID]],
            [[BaseUserIncomePeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseUserIncomePeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseUserIncomePeer::USER_INCOME_ID => 'User Income ID',
            BaseUserIncomePeer::USER_ID => 'User ID',
            BaseUserIncomePeer::CURRENCY_ID => 'Currency ID',
            BaseUserIncomePeer::SOURCE_TYPE => 'Source Type',
            BaseUserIncomePeer::SOURCE_ID => 'Source ID',
            BaseUserIncomePeer::INCOME_TYPE => 'Income Type',
            BaseUserIncomePeer::VALUE => 'Value',
            BaseUserIncomePeer::STATUS => 'Status',
            BaseUserIncomePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\CurrencyQuery
     */
    public function getCurrency() {
        return $this->hasOne(\models\Currency::className(), [BaseCurrencyPeer::CURRENCY_ID => BaseUserIncomePeer::CURRENCY_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseUserIncomePeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\UserIncomeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\UserIncomeQuery(get_called_class());
    }
}
