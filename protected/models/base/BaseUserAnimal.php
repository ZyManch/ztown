<?php

namespace models\base;



/**
 * This is the model class for table "city.user_animal".
 *
 * @property string $user_animal_id
 * @property string $user_id
 * @property string $animal_id
 * @property string $stat_id
 * @property string $level
 * @property string $exp
 * @property string $status
 * @property string $changed
 *
 * @property \models\Animal $animal
 * @property \models\Stat $stat
 * @property \models\User $user
 */
class BaseUserAnimal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.user_animal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseUserAnimalPeer::USER_ID, BaseUserAnimalPeer::ANIMAL_ID, BaseUserAnimalPeer::STAT_ID, BaseUserAnimalPeer::LEVEL, BaseUserAnimalPeer::EXP], 'integer'],
            [[BaseUserAnimalPeer::STATUS], 'string'],
            [[BaseUserAnimalPeer::CHANGED], 'safe'],
            [[BaseUserAnimalPeer::ANIMAL_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseAnimal::className(), 'targetAttribute' => [BaseUserAnimalPeer::ANIMAL_ID => BaseAnimalPeer::ANIMAL_ID]],
            [[BaseUserAnimalPeer::STAT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStat::className(), 'targetAttribute' => [BaseUserAnimalPeer::STAT_ID => BaseStatPeer::STAT_ID]],
            [[BaseUserAnimalPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseUserAnimalPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseUserAnimalPeer::USER_ANIMAL_ID => 'User Animal ID',
            BaseUserAnimalPeer::USER_ID => 'User ID',
            BaseUserAnimalPeer::ANIMAL_ID => 'Animal ID',
            BaseUserAnimalPeer::STAT_ID => 'Stat ID',
            BaseUserAnimalPeer::LEVEL => 'Level',
            BaseUserAnimalPeer::EXP => 'Exp',
            BaseUserAnimalPeer::STATUS => 'Status',
            BaseUserAnimalPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\AnimalQuery
     */
    public function getAnimal() {
        return $this->hasOne(\models\Animal::className(), [BaseAnimalPeer::ANIMAL_ID => BaseUserAnimalPeer::ANIMAL_ID]);
    }
        /**
     * @return \models\StatQuery
     */
    public function getStat() {
        return $this->hasOne(\models\Stat::className(), [BaseStatPeer::STAT_ID => BaseUserAnimalPeer::STAT_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseUserAnimalPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\UserAnimalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\UserAnimalQuery(get_called_class());
    }
}
