<?php

namespace models\base;



/**
 * This is the model class for table "city.street".
 *
 * @property string $street_id
 * @property string $name
 * @property string $left_x
 * @property string $right_x
 * @property string $top_y
 * @property string $bottom_y
 * @property string $status
 * @property string $changed
 *
 * @property \models\Map[] $maps
 */
class BaseStreet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.street';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseStreetPeer::NAME, BaseStreetPeer::LEFT_X, BaseStreetPeer::RIGHT_X, BaseStreetPeer::TOP_Y, BaseStreetPeer::BOTTOM_Y], 'required'],
            [[BaseStreetPeer::LEFT_X, BaseStreetPeer::RIGHT_X, BaseStreetPeer::TOP_Y, BaseStreetPeer::BOTTOM_Y], 'integer'],
            [[BaseStreetPeer::STATUS], 'string'],
            [[BaseStreetPeer::CHANGED], 'safe'],
            [[BaseStreetPeer::NAME], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseStreetPeer::STREET_ID => 'Street ID',
            BaseStreetPeer::NAME => 'Name',
            BaseStreetPeer::LEFT_X => 'Left X',
            BaseStreetPeer::RIGHT_X => 'Right X',
            BaseStreetPeer::TOP_Y => 'Top Y',
            BaseStreetPeer::BOTTOM_Y => 'Bottom Y',
            BaseStreetPeer::STATUS => 'Status',
            BaseStreetPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\MapQuery
     */
    public function getMaps() {
        return $this->hasMany(\models\Map::className(), [BaseMapPeer::STREET_ID => BaseStreetPeer::STREET_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\StreetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\StreetQuery(get_called_class());
    }
}
