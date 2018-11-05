<?php

namespace models\base;



/**
 * This is the model class for table "city.animal".
 *
 * @property string $animal_id
 * @property integer $level
 * @property string $stat_id
 * @property string $name
 * @property string $type
 * @property string $content
 * @property string $status
 * @property string $changed
 *
 * @property \models\Stat $stat
 * @property \models\UserAnimal[] $userAnimals
 */
class BaseAnimal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.animal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseAnimalPeer::LEVEL, BaseAnimalPeer::STAT_ID], 'integer'],
            [[BaseAnimalPeer::STAT_ID, BaseAnimalPeer::NAME, BaseAnimalPeer::TYPE], 'required'],
            [[BaseAnimalPeer::STATUS], 'string'],
            [[BaseAnimalPeer::CHANGED], 'safe'],
            [[BaseAnimalPeer::NAME], 'string', 'max' => 32],
            [[BaseAnimalPeer::TYPE], 'string', 'max' => 5],
            [[BaseAnimalPeer::CONTENT], 'string', 'max' => 128],
            [[BaseAnimalPeer::STAT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStat::className(), 'targetAttribute' => [BaseAnimalPeer::STAT_ID => BaseStatPeer::STAT_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseAnimalPeer::ANIMAL_ID => 'Animal ID',
            BaseAnimalPeer::LEVEL => 'Level',
            BaseAnimalPeer::STAT_ID => 'Stat ID',
            BaseAnimalPeer::NAME => 'Name',
            BaseAnimalPeer::TYPE => 'Type',
            BaseAnimalPeer::CONTENT => 'Content',
            BaseAnimalPeer::STATUS => 'Status',
            BaseAnimalPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\StatQuery
     */
    public function getStat() {
        return $this->hasOne(\models\Stat::className(), [BaseStatPeer::STAT_ID => BaseAnimalPeer::STAT_ID]);
    }
        /**
     * @return \models\UserAnimalQuery
     */
    public function getUserAnimals() {
        return $this->hasMany(\models\UserAnimal::className(), [BaseUserAnimalPeer::ANIMAL_ID => BaseAnimalPeer::ANIMAL_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\AnimalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\AnimalQuery(get_called_class());
    }
}
