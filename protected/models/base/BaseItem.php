<?php

namespace models\base;



/**
 * This is the model class for table "city.item".
 *
 * @property string $item_id
 * @property string $name
 * @property string $type
 * @property string $group
 * @property string $delonuse
 * @property string $stat_id
 * @property string $level
 * @property string $selling
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property \models\Stat $stat
 * @property \models\ItemBuied[] $itemBuieds
 * @property \models\ItemOpened[] $itemOpeneds
 */
class BaseItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseItemPeer::NAME, BaseItemPeer::GROUP, BaseItemPeer::DELONUSE, BaseItemPeer::STAT_ID, BaseItemPeer::LEVEL], 'required'],
            [[BaseItemPeer::TYPE, BaseItemPeer::SELLING, BaseItemPeer::CONTENT, BaseItemPeer::STATUS], 'string'],
            [[BaseItemPeer::GROUP, BaseItemPeer::DELONUSE, BaseItemPeer::STAT_ID, BaseItemPeer::LEVEL], 'integer'],
            [[BaseItemPeer::CHANGED], 'safe'],
            [[BaseItemPeer::NAME], 'string', 'max' => 24],
            [[BaseItemPeer::STAT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStat::className(), 'targetAttribute' => [BaseItemPeer::STAT_ID => BaseStatPeer::STAT_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseItemPeer::ITEM_ID => 'Item ID',
            BaseItemPeer::NAME => 'Name',
            BaseItemPeer::TYPE => 'Type',
            BaseItemPeer::GROUP => 'Group',
            BaseItemPeer::DELONUSE => 'Delonuse',
            BaseItemPeer::STAT_ID => 'Stat ID',
            BaseItemPeer::LEVEL => 'Level',
            BaseItemPeer::SELLING => 'Selling',
            BaseItemPeer::CONTENT => 'Content',
            BaseItemPeer::STATUS => 'Status',
            BaseItemPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\StatQuery
     */
    public function getStat() {
        return $this->hasOne(\models\Stat::className(), [BaseStatPeer::STAT_ID => BaseItemPeer::STAT_ID]);
    }
        /**
     * @return \models\ItemBuiedQuery
     */
    public function getItemBuieds() {
        return $this->hasMany(\models\ItemBuied::className(), [BaseItemBuiedPeer::ITEM_ID => BaseItemPeer::ITEM_ID]);
    }
        /**
     * @return \models\ItemOpenedQuery
     */
    public function getItemOpeneds() {
        return $this->hasMany(\models\ItemOpened::className(), [BaseItemOpenedPeer::ITEM_ID => BaseItemPeer::ITEM_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\ItemQuery(get_called_class());
    }
}
