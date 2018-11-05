<?php

namespace models\base;



/**
 * This is the model class for table "city.work_bonus".
 *
 * @property string $work_bonus_id
 * @property string $work_id
 * @property string $add_sub_levels
 * @property string $status
 * @property string $changed
 *
 * @property \models\Work $work
 */
class BaseWorkBonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.work_bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseWorkBonusPeer::WORK_ID, BaseWorkBonusPeer::ADD_SUB_LEVELS], 'integer'],
            [[BaseWorkBonusPeer::STATUS], 'string'],
            [[BaseWorkBonusPeer::CHANGED], 'safe'],
            [[BaseWorkBonusPeer::WORK_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseWork::className(), 'targetAttribute' => [BaseWorkBonusPeer::WORK_ID => BaseWorkPeer::WORK_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseWorkBonusPeer::WORK_BONUS_ID => 'Work Bonus ID',
            BaseWorkBonusPeer::WORK_ID => 'Work ID',
            BaseWorkBonusPeer::ADD_SUB_LEVELS => 'Add Sub Levels',
            BaseWorkBonusPeer::STATUS => 'Status',
            BaseWorkBonusPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\WorkQuery
     */
    public function getWork() {
        return $this->hasOne(\models\Work::className(), [BaseWorkPeer::WORK_ID => BaseWorkBonusPeer::WORK_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\WorkBonusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\WorkBonusQuery(get_called_class());
    }
}
