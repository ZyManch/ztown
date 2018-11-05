<?php

namespace models\base;



/**
 * This is the model class for table "city.map_work".
 *
 * @property string $map_work_id
 * @property string $map_id
 * @property string $work_id
 * @property string $count
 * @property string $status
 * @property string $changed
 *
 * @property \models\Map $map
 * @property \models\Work $work
 */
class BaseMapWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.map_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMapWorkPeer::MAP_ID, BaseMapWorkPeer::WORK_ID, BaseMapWorkPeer::COUNT], 'required'],
            [[BaseMapWorkPeer::MAP_ID, BaseMapWorkPeer::WORK_ID, BaseMapWorkPeer::COUNT], 'integer'],
            [[BaseMapWorkPeer::STATUS], 'string'],
            [[BaseMapWorkPeer::CHANGED], 'safe'],
            [[BaseMapWorkPeer::MAP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMap::className(), 'targetAttribute' => [BaseMapWorkPeer::MAP_ID => BaseMapPeer::MAP_ID]],
            [[BaseMapWorkPeer::WORK_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseWork::className(), 'targetAttribute' => [BaseMapWorkPeer::WORK_ID => BaseWorkPeer::WORK_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMapWorkPeer::MAP_WORK_ID => 'Map Work ID',
            BaseMapWorkPeer::MAP_ID => 'Map ID',
            BaseMapWorkPeer::WORK_ID => 'Work ID',
            BaseMapWorkPeer::COUNT => 'Count',
            BaseMapWorkPeer::STATUS => 'Status',
            BaseMapWorkPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\MapQuery
     */
    public function getMap() {
        return $this->hasOne(\models\Map::className(), [BaseMapPeer::MAP_ID => BaseMapWorkPeer::MAP_ID]);
    }
        /**
     * @return \models\WorkQuery
     */
    public function getWork() {
        return $this->hasOne(\models\Work::className(), [BaseWorkPeer::WORK_ID => BaseMapWorkPeer::WORK_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\MapWorkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MapWorkQuery(get_called_class());
    }
}
