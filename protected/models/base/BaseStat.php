<?php

namespace models\base;



/**
 * This is the model class for table "city.stat".
 *
 * @property string $stat_id
 * @property string $stat1
 * @property string $stat2
 * @property string $stat3
 * @property string $stat4
 * @property string $stat5
 * @property string $stat6
 * @property string $bonus1
 * @property string $bonus2
 * @property string $bonus3
 * @property string $bonus4
 * @property string $bonus5
 * @property string $bonus6
 * @property string $status
 * @property string $changed
 *
 * @property \models\Animal[] $animals
 * @property \models\BattleUser[] $battleUsers
 * @property \models\Item[] $items
 * @property \models\ItemBuied[] $itemBuieds
 * @property \models\User[] $users
 * @property \models\UserAnimal[] $userAnimals
 */
class BaseStat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.stat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseStatPeer::STAT1, BaseStatPeer::STAT2, BaseStatPeer::STAT3, BaseStatPeer::STAT4, BaseStatPeer::STAT5, BaseStatPeer::STAT6, BaseStatPeer::BONUS1, BaseStatPeer::BONUS2, BaseStatPeer::BONUS3, BaseStatPeer::BONUS4, BaseStatPeer::BONUS5, BaseStatPeer::BONUS6], 'integer'],
            [[BaseStatPeer::STATUS], 'string'],
            [[BaseStatPeer::CHANGED], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseStatPeer::STAT_ID => 'Stat ID',
            BaseStatPeer::STAT1 => 'Stat1',
            BaseStatPeer::STAT2 => 'Stat2',
            BaseStatPeer::STAT3 => 'Stat3',
            BaseStatPeer::STAT4 => 'Stat4',
            BaseStatPeer::STAT5 => 'Stat5',
            BaseStatPeer::STAT6 => 'Stat6',
            BaseStatPeer::BONUS1 => 'Bonus1',
            BaseStatPeer::BONUS2 => 'Bonus2',
            BaseStatPeer::BONUS3 => 'Bonus3',
            BaseStatPeer::BONUS4 => 'Bonus4',
            BaseStatPeer::BONUS5 => 'Bonus5',
            BaseStatPeer::BONUS6 => 'Bonus6',
            BaseStatPeer::STATUS => 'Status',
            BaseStatPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\AnimalQuery
     */
    public function getAnimals() {
        return $this->hasMany(\models\Animal::className(), [BaseAnimalPeer::STAT_ID => BaseStatPeer::STAT_ID]);
    }
        /**
     * @return \models\BattleUserQuery
     */
    public function getBattleUsers() {
        return $this->hasMany(\models\BattleUser::className(), [BaseBattleUserPeer::STAT_ID => BaseStatPeer::STAT_ID]);
    }
        /**
     * @return \models\ItemQuery
     */
    public function getItems() {
        return $this->hasMany(\models\Item::className(), [BaseItemPeer::STAT_ID => BaseStatPeer::STAT_ID]);
    }
        /**
     * @return \models\ItemBuiedQuery
     */
    public function getItemBuieds() {
        return $this->hasMany(\models\ItemBuied::className(), [BaseItemBuiedPeer::STAT_ID => BaseStatPeer::STAT_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUsers() {
        return $this->hasMany(\models\User::className(), [BaseUserPeer::STAT_ID => BaseStatPeer::STAT_ID]);
    }
        /**
     * @return \models\UserAnimalQuery
     */
    public function getUserAnimals() {
        return $this->hasMany(\models\UserAnimal::className(), [BaseUserAnimalPeer::STAT_ID => BaseStatPeer::STAT_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\StatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\StatQuery(get_called_class());
    }
}
