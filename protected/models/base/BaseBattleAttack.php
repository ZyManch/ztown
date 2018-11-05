<?php

namespace models\base;



/**
 * This is the model class for table "city.battle_attack".
 *
 * @property string $battle_attack_id
 * @property string $battle_id
 * @property string $from_user_id
 * @property string $to_user_id
 * @property string $step
 * @property string $text
 * @property string $power
 * @property string $status
 * @property string $changed
 *
 * @property \models\Battle $battle
 * @property \models\User $fromUser
 * @property \models\User $toUser
 */
class BaseBattleAttack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.battle_attack';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseBattleAttackPeer::BATTLE_ID, BaseBattleAttackPeer::FROM_USER_ID, BaseBattleAttackPeer::TO_USER_ID, BaseBattleAttackPeer::STEP, BaseBattleAttackPeer::TEXT, BaseBattleAttackPeer::POWER], 'required'],
            [[BaseBattleAttackPeer::BATTLE_ID, BaseBattleAttackPeer::FROM_USER_ID, BaseBattleAttackPeer::TO_USER_ID, BaseBattleAttackPeer::STEP, BaseBattleAttackPeer::TEXT, BaseBattleAttackPeer::POWER], 'integer'],
            [[BaseBattleAttackPeer::STATUS], 'string'],
            [[BaseBattleAttackPeer::CHANGED], 'safe'],
            [[BaseBattleAttackPeer::BATTLE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseBattle::className(), 'targetAttribute' => [BaseBattleAttackPeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]],
            [[BaseBattleAttackPeer::FROM_USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseBattleAttackPeer::FROM_USER_ID => BaseUserPeer::USER_ID]],
            [[BaseBattleAttackPeer::TO_USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseBattleAttackPeer::TO_USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseBattleAttackPeer::BATTLE_ATTACK_ID => 'Battle Attack ID',
            BaseBattleAttackPeer::BATTLE_ID => 'Battle ID',
            BaseBattleAttackPeer::FROM_USER_ID => 'From User ID',
            BaseBattleAttackPeer::TO_USER_ID => 'To User ID',
            BaseBattleAttackPeer::STEP => 'Step',
            BaseBattleAttackPeer::TEXT => 'Text',
            BaseBattleAttackPeer::POWER => 'Power',
            BaseBattleAttackPeer::STATUS => 'Status',
            BaseBattleAttackPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\BattleQuery
     */
    public function getBattle() {
        return $this->hasOne(\models\Battle::className(), [BaseBattlePeer::BATTLE_ID => BaseBattleAttackPeer::BATTLE_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getFromUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseBattleAttackPeer::FROM_USER_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getToUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseBattleAttackPeer::TO_USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\BattleAttackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\BattleAttackQuery(get_called_class());
    }
}
