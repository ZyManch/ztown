<?php

namespace models\base;



/**
 * This is the model class for table "city.battle_user".
 *
 * @property string $battle_user_id
 * @property string $battle_id
 * @property string $user_id
 * @property string $stat_id
 * @property string $side
 * @property string $status
 * @property string $changed
 *
 * @property \models\Battle $battle
 * @property \models\Stat $stat
 * @property \models\User $user
 */
class BaseBattleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.battle_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseBattleUserPeer::BATTLE_ID, BaseBattleUserPeer::USER_ID, BaseBattleUserPeer::STAT_ID, BaseBattleUserPeer::SIDE], 'required'],
            [[BaseBattleUserPeer::BATTLE_ID, BaseBattleUserPeer::USER_ID, BaseBattleUserPeer::STAT_ID], 'integer'],
            [[BaseBattleUserPeer::SIDE, BaseBattleUserPeer::STATUS], 'string'],
            [[BaseBattleUserPeer::CHANGED], 'safe'],
            [[BaseBattleUserPeer::BATTLE_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseBattle::className(), 'targetAttribute' => [BaseBattleUserPeer::BATTLE_ID => BaseBattlePeer::BATTLE_ID]],
            [[BaseBattleUserPeer::STAT_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseStat::className(), 'targetAttribute' => [BaseBattleUserPeer::STAT_ID => BaseStatPeer::STAT_ID]],
            [[BaseBattleUserPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseBattleUserPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseBattleUserPeer::BATTLE_USER_ID => 'Battle User ID',
            BaseBattleUserPeer::BATTLE_ID => 'Battle ID',
            BaseBattleUserPeer::USER_ID => 'User ID',
            BaseBattleUserPeer::STAT_ID => 'Stat ID',
            BaseBattleUserPeer::SIDE => 'Side',
            BaseBattleUserPeer::STATUS => 'Status',
            BaseBattleUserPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\BattleQuery
     */
    public function getBattle() {
        return $this->hasOne(\models\Battle::className(), [BaseBattlePeer::BATTLE_ID => BaseBattleUserPeer::BATTLE_ID]);
    }
        /**
     * @return \models\StatQuery
     */
    public function getStat() {
        return $this->hasOne(\models\Stat::className(), [BaseStatPeer::STAT_ID => BaseBattleUserPeer::STAT_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseBattleUserPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\BattleUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\BattleUserQuery(get_called_class());
    }
}
