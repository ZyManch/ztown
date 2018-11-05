<?php

namespace models\base;



/**
 * This is the model class for table "city.map_type".
 *
 * @property string $map_type_id
 * @property string $image
 * @property string $name
 * @property string $controller
 * @property string $model
 * @property string $info
 * @property string $params
 * @property integer $markup_max
 * @property integer $level_max
 * @property string $build_type_id
 * @property string $main_type_id
 * @property string $can_build
 * @property string $can_take
 * @property string $type
 * @property string $status
 * @property string $changed
 *
 * @property \models\Income[] $incomes
 * @property \models\Map[] $maps
 * @property \models\Map[] $maps0
 * @property \models\MapType $buildType
 * @property \models\MapType[] $mapTypes
 * @property \models\MapType $mainType
 * @property \models\MapType[] $mapTypes0
 * @property \models\Work[] $works
 */
class BaseMapType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.map_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMapTypePeer::IMAGE, BaseMapTypePeer::NAME, BaseMapTypePeer::CONTROLLER, BaseMapTypePeer::INFO, BaseMapTypePeer::PARAMS, BaseMapTypePeer::MARKUP_MAX], 'required'],
            [[BaseMapTypePeer::INFO, BaseMapTypePeer::PARAMS, BaseMapTypePeer::CAN_BUILD, BaseMapTypePeer::CAN_TAKE, BaseMapTypePeer::TYPE, BaseMapTypePeer::STATUS], 'string'],
            [[BaseMapTypePeer::MARKUP_MAX, BaseMapTypePeer::LEVEL_MAX, BaseMapTypePeer::BUILD_TYPE_ID, BaseMapTypePeer::MAIN_TYPE_ID], 'integer'],
            [[BaseMapTypePeer::CHANGED], 'safe'],
            [[BaseMapTypePeer::IMAGE, BaseMapTypePeer::NAME], 'string', 'max' => 32],
            [[BaseMapTypePeer::CONTROLLER], 'string', 'max' => 8],
            [[BaseMapTypePeer::MODEL], 'string', 'max' => 16],
            [[BaseMapTypePeer::BUILD_TYPE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMapType::className(), 'targetAttribute' => [BaseMapTypePeer::BUILD_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]],
            [[BaseMapTypePeer::MAIN_TYPE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMapType::className(), 'targetAttribute' => [BaseMapTypePeer::MAIN_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMapTypePeer::MAP_TYPE_ID => 'Map Type ID',
            BaseMapTypePeer::IMAGE => 'Image',
            BaseMapTypePeer::NAME => 'Name',
            BaseMapTypePeer::CONTROLLER => 'Controller',
            BaseMapTypePeer::MODEL => 'Model',
            BaseMapTypePeer::INFO => 'Info',
            BaseMapTypePeer::PARAMS => 'Params',
            BaseMapTypePeer::MARKUP_MAX => 'Markup Max',
            BaseMapTypePeer::LEVEL_MAX => 'Level Max',
            BaseMapTypePeer::BUILD_TYPE_ID => 'Build Type ID',
            BaseMapTypePeer::MAIN_TYPE_ID => 'Main Type ID',
            BaseMapTypePeer::CAN_BUILD => 'Can Build',
            BaseMapTypePeer::CAN_TAKE => 'Can Take',
            BaseMapTypePeer::TYPE => 'Type',
            BaseMapTypePeer::STATUS => 'Status',
            BaseMapTypePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\IncomeQuery
     */
    public function getIncomes() {
        return $this->hasMany(\models\Income::className(), [BaseIncomePeer::MAP_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMaps() {
        return $this->hasMany(\models\Map::className(), [BaseMapPeer::LAND_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMaps0() {
        return $this->hasMany(\models\Map::className(), [BaseMapPeer::MAP_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getBuildType() {
        return $this->hasOne(\models\MapType::className(), [BaseMapTypePeer::MAP_TYPE_ID => BaseMapTypePeer::BUILD_TYPE_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getMapTypes() {
        return $this->hasMany(\models\MapType::className(), [BaseMapTypePeer::BUILD_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getMainType() {
        return $this->hasOne(\models\MapType::className(), [BaseMapTypePeer::MAP_TYPE_ID => BaseMapTypePeer::MAIN_TYPE_ID]);
    }
        /**
     * @return \models\MapTypeQuery
     */
    public function getMapTypes0() {
        return $this->hasMany(\models\MapType::className(), [BaseMapTypePeer::MAIN_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]);
    }
        /**
     * @return \models\WorkQuery
     */
    public function getWorks() {
        return $this->hasMany(\models\Work::className(), [BaseWorkPeer::MAP_TYPE_ID => BaseMapTypePeer::MAP_TYPE_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\MapTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MapTypeQuery(get_called_class());
    }
}
