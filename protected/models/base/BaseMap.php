<?php

namespace models\base;



/**
 * This is the model class for table "city.map".
 *
 * @property string $map_id
 * @property string $parent_map_id
 * @property string $land_type_id
 * @property string $map_type_id
 * @property string $x
 * @property string $y
 * @property string $user_id
 * @property string $street_id
 * @property string $roof_id
 * @property string $house
 * @property string $last_sell
 * @property string $param2
 * @property string $level
 * @property string $markup
 * @property string $status
 * @property string $changed
 *
 * @property \models\House[] $houses
 * @property \models\MafiaInfo[] $mafiaInfos
 * @property \models\MapType $landType
 * @property \models\MapType $mapType
 * @property \models\Map $parentMap
 * @property \models\Map[] $maps
 * @property \models\User $roof
 * @property \models\Street $street
 * @property \models\User $user
 * @property \models\MapWork[] $mapWorks
 * @property \models\Money[] $moneys
 */
class BaseMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMapPeer::PARENT_MAP_ID, BaseMapPeer::LAND_TYPE_ID, BaseMapPeer::MAP_TYPE_ID, BaseMapPeer::X, BaseMapPeer::Y, BaseMapPeer::USER_ID, BaseMapPeer::STREET_ID, BaseMapPeer::ROOF_ID, BaseMapPeer::HOUSE, BaseMapPeer::LAST_SELL, BaseMapPeer::PARAM2, BaseMapPeer::LEVEL], 'integer'],
            [[BaseMapPeer::LAND_TYPE_ID, BaseMapPeer::X, BaseMapPeer::Y, BaseMapPeer::PARAM2, BaseMapPeer::MARKUP], 'required'],
            [[BaseMapPeer::MARKUP], 'number'],
            [[BaseMapPeer::STATUS], 'string'],
            [[BaseMapPeer::CHANGED], 'safe'],
            [[BaseMapPeer::LAND_TYPE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMapType::className(), 'targetAttribute' => [BaseMapPeer::LAND_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]],
            [[BaseMapPeer::MAP_TYPE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMapType::className(), 'targetAttribute' => [BaseMapPeer::MAP_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]],
            [[BaseMapPeer::PARENT_MAP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMap::className(), 'targetAttribute' => [BaseMapPeer::PARENT_MAP_ID => BaseMapPeer::MAP_ID]],
            [[BaseMapPeer::ROOF_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseMapPeer::ROOF_ID => BaseUserPeer::USER_ID]],
            [[BaseMapPeer::STREET_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStreet::className(), 'targetAttribute' => [BaseMapPeer::STREET_ID => BaseStreetPeer::STREET_ID]],
            [[BaseMapPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseMapPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMapPeer::MAP_ID => 'Map ID',
            BaseMapPeer::PARENT_MAP_ID => 'Parent Map ID',
            BaseMapPeer::LAND_TYPE_ID => 'Land Type ID',
            BaseMapPeer::MAP_TYPE_ID => 'Map Type ID',
            BaseMapPeer::X => 'X',
            BaseMapPeer::Y => 'Y',
            BaseMapPeer::USER_ID => 'User ID',
            BaseMapPeer::STREET_ID => 'Street ID',
            BaseMapPeer::ROOF_ID => 'Roof ID',
            BaseMapPeer::HOUSE => 'House',
            BaseMapPeer::LAST_SELL => 'Last Sell',
            BaseMapPeer::PARAM2 => 'Param2',
            BaseMapPeer::LEVEL => 'Level',
            BaseMapPeer::MARKUP => 'Markup',
            BaseMapPeer::STATUS => 'Status',
            BaseMapPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\HouseQuery
     */
    public function getHouses() {
        return $this->hasMany(\models\House::className(), [BaseHousePeer::MAP_ID => BaseMapPeer::MAP_ID]);
    }
        /**
     * @return \models\MafiaInfoQuery
     */
    public function getMafiaInfos() {
        return $this->hasMany(\models\MafiaInfo::className(), [BaseMafiaInfoPeer::MAP_ID => BaseMapPeer::MAP_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getLandType() {
        return $this->hasOne(\models\MapType::className(), [BaseMapTypePeer::MAP_TYPE_ID => BaseMapPeer::LAND_TYPE_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getMapType() {
        return $this->hasOne(\models\MapType::className(), [BaseMapTypePeer::MAP_TYPE_ID => BaseMapPeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getParentMap() {
        return $this->hasOne(\models\Map::className(), [BaseMapPeer::MAP_ID => BaseMapPeer::PARENT_MAP_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMaps() {
        return $this->hasMany(\models\Map::className(), [BaseMapPeer::PARENT_MAP_ID => BaseMapPeer::MAP_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getRoof() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseMapPeer::ROOF_ID]);
    }
        /**
     * @return \models\StreetQuery
     */
    public function getStreet() {
        return $this->hasOne(\models\Street::className(), [BaseStreetPeer::STREET_ID => BaseMapPeer::STREET_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseMapPeer::USER_ID]);
    }
        /**
     * @return \models\MapWorkQuery
     */
    public function getMapWorks() {
        return $this->hasMany(\models\MapWork::className(), [BaseMapWorkPeer::MAP_ID => BaseMapPeer::MAP_ID]);
    }
        /**
     * @return \models\MoneyQuery
     */
    public function getMoneys() {
        return $this->hasMany(\models\Money::className(), [BaseMoneyPeer::MAP_ID => BaseMapPeer::MAP_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\MapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MapQuery(get_called_class());
    }
}
