<?php

namespace models\base;



/**
 * This is the model class for table "city.work".
 *
 * @property string $work_id
 * @property string $map_type_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $price_id
 * @property string $status
 * @property string $changed
 *
 * @property \models\MapWork[] $mapWorks
 * @property \models\MapType $mapType
 * @property \models\Price $price
 * @property \models\WorkBonus[] $workBonuses
 */
class BaseWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseWorkPeer::MAP_TYPE_ID, BaseWorkPeer::PRICE_ID], 'integer'],
            [[BaseWorkPeer::DESCRIPTION, BaseWorkPeer::STATUS], 'string'],
            [[BaseWorkPeer::CHANGED], 'safe'],
            [[BaseWorkPeer::TITLE], 'string', 'max' => 128],
            [[BaseWorkPeer::IMAGE], 'string', 'max' => 32],
            [[BaseWorkPeer::MAP_TYPE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMapType::className(), 'targetAttribute' => [BaseWorkPeer::MAP_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]],
            [[BaseWorkPeer::PRICE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BasePrice::className(), 'targetAttribute' => [BaseWorkPeer::PRICE_ID => BasePricePeer::PRICE_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseWorkPeer::WORK_ID => 'Work ID',
            BaseWorkPeer::MAP_TYPE_ID => 'Map Type ID',
            BaseWorkPeer::TITLE => 'Title',
            BaseWorkPeer::IMAGE => 'Image',
            BaseWorkPeer::DESCRIPTION => 'Description',
            BaseWorkPeer::PRICE_ID => 'Price ID',
            BaseWorkPeer::STATUS => 'Status',
            BaseWorkPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\MapWorkQuery
     */
    public function getMapWorks() {
        return $this->hasMany(\models\MapWork::className(), [BaseMapWorkPeer::WORK_ID => BaseWorkPeer::WORK_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getMapType() {
        return $this->hasOne(\models\MapType::className(), [BaseMapTypePeer::MAP_TYPE_ID => BaseWorkPeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\PriceQuery
     */
    public function getPrice() {
        return $this->hasOne(\models\Price::className(), [BasePricePeer::PRICE_ID => BaseWorkPeer::PRICE_ID]);
    }
        /**
     * @return \models\WorkBonusQuery
     */
    public function getWorkBonuses() {
        return $this->hasMany(\models\WorkBonus::className(), [BaseWorkBonusPeer::WORK_ID => BaseWorkPeer::WORK_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\WorkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\WorkQuery(get_called_class());
    }
}
