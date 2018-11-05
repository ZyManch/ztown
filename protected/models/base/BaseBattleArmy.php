<?php

namespace models\base;



/**
 * This is the model class for table "city.battle_army".
 *
 * @property string $battle_army_id
 * @property string $parent_id
 * @property string $battle_id
 * @property string $stat
 * @property string $name
 * @property string $status
 * @property string $changed
 *
 * @property \models\Battle $battle
 */
class BaseBattleArmy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.battle_army';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseBattleArmyPeer::PARENT_ID, BaseBattleArmyPeer::BATTLE_ID, BaseBattleArmyPeer::STAT, BaseBattleArmyPeer::NAME], 'required'],
            [[BaseBattleArmyPeer::PARENT_ID, BaseBattleArmyPeer::BATTLE_ID, BaseBattleArmyPeer::STAT], 'integer'],
            [[BaseBattleArmyPeer::STATUS], 'string'],
            [[BaseBattleArmyPeer::CHANGED], 'safe'],
            [[BaseBattleArmyPeer::NAME], 'string', 'max' => 32],
            [[BaseBattleArmyPeer::BATTLE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseBattle::className(), 'targetAttribute' => [BaseBattleArmyPeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseBattleArmyPeer::BATTLE_ARMY_ID => 'Battle Army ID',
            BaseBattleArmyPeer::PARENT_ID => 'Parent ID',
            BaseBattleArmyPeer::BATTLE_ID => 'Battle ID',
            BaseBattleArmyPeer::STAT => 'Stat',
            BaseBattleArmyPeer::NAME => 'Name',
            BaseBattleArmyPeer::STATUS => 'Status',
            BaseBattleArmyPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\BattleQuery
     */
    public function getBattle() {
        return $this->hasOne(\models\Battle::className(), [BaseBattlePeer::BATTLE_ID => BaseBattleArmyPeer::BATTLE_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\BattleArmyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\BattleArmyQuery(get_called_class());
    }
}
