<?php

namespace models\base;



/**
 * This is the model class for table "city.battle".
 *
 * @property string $battle_id
 * @property string $win_side
 * @property string $hash
 * @property string $status
 * @property string $changed
 *
 * @property \models\BattleArmy[] $battleArmies
 * @property \models\BattleAttack[] $battleAttacks
 * @property \models\BattlePrize[] $battlePrizes
 * @property \models\BattleUser[] $battleUsers
 */
class BaseBattle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.battle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseBattlePeer::WIN_SIDE, BaseBattlePeer::HASH], 'required'],
            [[BaseBattlePeer::WIN_SIDE, BaseBattlePeer::STATUS], 'string'],
            [[BaseBattlePeer::CHANGED], 'safe'],
            [[BaseBattlePeer::HASH], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseBattlePeer::BATTLE_ID => 'Battle ID',
            BaseBattlePeer::WIN_SIDE => 'Win Side',
            BaseBattlePeer::HASH => 'Hash',
            BaseBattlePeer::STATUS => 'Status',
            BaseBattlePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\BattleArmyQuery
     */
    public function getBattleArmies() {
        return $this->hasMany(\models\BattleArmy::className(), [BaseBattleArmyPeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]);
    }
        /**
     * @return \models\BattleAttackQuery
     */
    public function getBattleAttacks() {
        return $this->hasMany(\models\BattleAttack::className(), [BaseBattleAttackPeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]);
    }
        /**
     * @return \models\BattlePrizeQuery
     */
    public function getBattlePrizes() {
        return $this->hasMany(\models\BattlePrize::className(), [BaseBattlePrizePeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]);
    }
        /**
     * @return \models\BattleUserQuery
     */
    public function getBattleUsers() {
        return $this->hasMany(\models\BattleUser::className(), [BaseBattleUserPeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\BattleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\BattleQuery(get_called_class());
    }
}
