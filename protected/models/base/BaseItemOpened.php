<?php

namespace models\base;



/**
 * This is the model class for table "city.item_opened".
 *
 * @property string $item_opened_id
 * @property string $item_id
 * @property string $user_id
 * @property string $status
 * @property string $changed
 *
 * @property \models\Item $item
 * @property \models\User $user
 */
class BaseItemOpened extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.item_opened';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseItemOpenedPeer::ITEM_ID, BaseItemOpenedPeer::USER_ID], 'required'],
            [[BaseItemOpenedPeer::ITEM_ID, BaseItemOpenedPeer::USER_ID], 'integer'],
            [[BaseItemOpenedPeer::STATUS], 'string'],
            [[BaseItemOpenedPeer::CHANGED], 'safe'],
            [[BaseItemOpenedPeer::ITEM_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseItem::className(), 'targetAttribute' => [BaseItemOpenedPeer::ITEM_ID => BaseItemPeer::ITEM_ID]],
            [[BaseItemOpenedPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseItemOpenedPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseItemOpenedPeer::ITEM_OPENED_ID => 'Item Opened ID',
            BaseItemOpenedPeer::ITEM_ID => 'Item ID',
            BaseItemOpenedPeer::USER_ID => 'User ID',
            BaseItemOpenedPeer::STATUS => 'Status',
            BaseItemOpenedPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\ItemQuery
     */
    public function getItem() {
        return $this->hasOne(\models\Item::className(), [BaseItemPeer::ITEM_ID => BaseItemOpenedPeer::ITEM_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseItemOpenedPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ItemOpenedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ItemOpenedQuery(get_called_class());
    }
}
