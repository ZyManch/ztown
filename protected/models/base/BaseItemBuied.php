<?php

namespace models\base;



/**
 * This is the model class for table "city.item_buied".
 *
 * @property string $item_buied_id
 * @property string $item_id
 * @property string $user_id
 * @property string $stat_id
 * @property string $used
 * @property string $level
 * @property string $light
 * @property string $status
 * @property string $changed
 *
 * @property \models\Item $item
 * @property \models\Stat $stat
 * @property \models\User $user
 */
class BaseItemBuied extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.item_buied';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseItemBuiedPeer::ITEM_ID, BaseItemBuiedPeer::USER_ID, BaseItemBuiedPeer::STAT_ID, BaseItemBuiedPeer::LEVEL], 'required'],
            [[BaseItemBuiedPeer::ITEM_ID, BaseItemBuiedPeer::USER_ID, BaseItemBuiedPeer::STAT_ID, BaseItemBuiedPeer::LEVEL], 'integer'],
            [[BaseItemBuiedPeer::USED, BaseItemBuiedPeer::LIGHT, BaseItemBuiedPeer::STATUS], 'string'],
            [[BaseItemBuiedPeer::CHANGED], 'safe'],
            [[BaseItemBuiedPeer::ITEM_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseItem::className(), 'targetAttribute' => [BaseItemBuiedPeer::ITEM_ID => BaseItemPeer::ITEM_ID]],
            [[BaseItemBuiedPeer::STAT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStat::className(), 'targetAttribute' => [BaseItemBuiedPeer::STAT_ID => BaseStatPeer::STAT_ID]],
            [[BaseItemBuiedPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseItemBuiedPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseItemBuiedPeer::ITEM_BUIED_ID => 'Item Buied ID',
            BaseItemBuiedPeer::ITEM_ID => 'Item ID',
            BaseItemBuiedPeer::USER_ID => 'User ID',
            BaseItemBuiedPeer::STAT_ID => 'Stat ID',
            BaseItemBuiedPeer::USED => 'Used',
            BaseItemBuiedPeer::LEVEL => 'Level',
            BaseItemBuiedPeer::LIGHT => 'Light',
            BaseItemBuiedPeer::STATUS => 'Status',
            BaseItemBuiedPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\ItemQuery
     */
    public function getItem() {
        return $this->hasOne(\models\Item::className(), [BaseItemPeer::ITEM_ID => BaseItemBuiedPeer::ITEM_ID]);
    }
        /**
     * @return \models\StatQuery
     */
    public function getStat() {
        return $this->hasOne(\models\Stat::className(), [BaseStatPeer::STAT_ID => BaseItemBuiedPeer::STAT_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseItemBuiedPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ItemBuiedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ItemBuiedQuery(get_called_class());
    }
}
