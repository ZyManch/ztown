<?php

namespace models\base;



/**
 * This is the model class for table "city.battle_prize".
 *
 * @property string $battle_prize_id
 * @property string $battle_id
 * @property string $user_id
 * @property string $prize_id
 * @property string $prize_type
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property \models\Battle $battle
 * @property \models\User $user
 */
class BaseBattlePrize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.battle_prize';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseBattlePrizePeer::BATTLE_ID, BaseBattlePrizePeer::USER_ID, BaseBattlePrizePeer::PRIZE_ID, BaseBattlePrizePeer::PRIZE_TYPE, BaseBattlePrizePeer::VALUE], 'required'],
            [[BaseBattlePrizePeer::BATTLE_ID, BaseBattlePrizePeer::USER_ID, BaseBattlePrizePeer::PRIZE_ID, BaseBattlePrizePeer::VALUE], 'integer'],
            [[BaseBattlePrizePeer::PRIZE_TYPE, BaseBattlePrizePeer::STATUS], 'string'],
            [[BaseBattlePrizePeer::CHANGED], 'safe'],
            [[BaseBattlePrizePeer::BATTLE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseBattle::className(), 'targetAttribute' => [BaseBattlePrizePeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]],
            [[BaseBattlePrizePeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseBattlePrizePeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseBattlePrizePeer::BATTLE_PRIZE_ID => 'Battle Prize ID',
            BaseBattlePrizePeer::BATTLE_ID => 'Battle ID',
            BaseBattlePrizePeer::USER_ID => 'User ID',
            BaseBattlePrizePeer::PRIZE_ID => 'Prize ID',
            BaseBattlePrizePeer::PRIZE_TYPE => 'Prize Type',
            BaseBattlePrizePeer::VALUE => 'Value',
            BaseBattlePrizePeer::STATUS => 'Status',
            BaseBattlePrizePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\BattleQuery
     */
    public function getBattle() {
        return $this->hasOne(\models\Battle::className(), [BaseBattlePeer::BATTLE_ID => BaseBattlePrizePeer::BATTLE_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseBattlePrizePeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\BattlePrizeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\BattlePrizeQuery(get_called_class());
    }
}
