<?php

namespace models\base;



/**
 * This is the model class for table "city.price".
 *
 * @property string $price_id
 * @property string $action
 * @property string $object_type
 * @property string $object_id
 * @property integer $level
 * @property string $status
 * @property string $changed
 *
 * @property \models\PriceValue[] $priceValues
 * @property \models\Work[] $works
 */
class BasePrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BasePricePeer::ACTION, BasePricePeer::OBJECT_TYPE, BasePricePeer::OBJECT_ID], 'required'],
            [[BasePricePeer::OBJECT_ID, BasePricePeer::LEVEL], 'integer'],
            [[BasePricePeer::STATUS], 'string'],
            [[BasePricePeer::CHANGED], 'safe'],
            [[BasePricePeer::ACTION, BasePricePeer::OBJECT_TYPE], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BasePricePeer::PRICE_ID => 'Price ID',
            BasePricePeer::ACTION => 'Action',
            BasePricePeer::OBJECT_TYPE => 'Object Type',
            BasePricePeer::OBJECT_ID => 'Object ID',
            BasePricePeer::LEVEL => 'Level',
            BasePricePeer::STATUS => 'Status',
            BasePricePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\PriceValueQuery
     */
    public function getPriceValues() {
        return $this->hasMany(\models\PriceValue::className(), [BasePriceValuePeer::PRICE_ID => BasePricePeer::PRICE_ID]);
    }
        /**
     * @return \models\WorkQuery
     */
    public function getWorks() {
        return $this->hasMany(\models\Work::className(), [BaseWorkPeer::PRICE_ID => BasePricePeer::PRICE_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\PriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\PriceQuery(get_called_class());
    }
}
