<?php

namespace models\base;



/**
 * This is the model class for table "city.house".
 *
 * @property string $house_id
 * @property string $map_id
 * @property string $user_id
 * @property string $last_pay
 * @property string $status
 * @property string $changed
 *
 * @property \models\Map $map
 * @property \models\User $user
 */
class BaseHouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseHousePeer::MAP_ID, BaseHousePeer::USER_ID], 'required'],
            [[BaseHousePeer::MAP_ID, BaseHousePeer::USER_ID], 'integer'],
            [[BaseHousePeer::LAST_PAY, BaseHousePeer::CHANGED], 'safe'],
            [[BaseHousePeer::STATUS], 'string'],
            [[BaseHousePeer::MAP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMap::className(), 'targetAttribute' => [BaseHousePeer::MAP_ID => BaseMapPeer::MAP_ID]],
            [[BaseHousePeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseHousePeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseHousePeer::HOUSE_ID => 'House ID',
            BaseHousePeer::MAP_ID => 'Map ID',
            BaseHousePeer::USER_ID => 'User ID',
            BaseHousePeer::LAST_PAY => 'Last Pay',
            BaseHousePeer::STATUS => 'Status',
            BaseHousePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\MapQuery
     */
    public function getMap() {
        return $this->hasOne(\models\Map::className(), [BaseMapPeer::MAP_ID => BaseHousePeer::MAP_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseHousePeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\HouseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\HouseQuery(get_called_class());
    }
}
