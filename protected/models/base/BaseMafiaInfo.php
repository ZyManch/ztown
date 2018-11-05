<?php

namespace models\base;



/**
 * This is the model class for table "city.mafia_info".
 *
 * @property string $mafia_info_id
 * @property string $group_id
 * @property string $map_id
 * @property string $user_id
 * @property string $status
 * @property string $changed
 *
 * @property \models\Group $group
 * @property \models\Map $map
 * @property \models\User $user
 */
class BaseMafiaInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.mafia_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMafiaInfoPeer::GROUP_ID, BaseMafiaInfoPeer::MAP_ID, BaseMafiaInfoPeer::USER_ID], 'required'],
            [[BaseMafiaInfoPeer::GROUP_ID, BaseMafiaInfoPeer::MAP_ID, BaseMafiaInfoPeer::USER_ID], 'integer'],
            [[BaseMafiaInfoPeer::STATUS], 'string'],
            [[BaseMafiaInfoPeer::CHANGED], 'safe'],
            [[BaseMafiaInfoPeer::GROUP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseGroup::className(), 'targetAttribute' => [BaseMafiaInfoPeer::GROUP_ID => BaseGroupPeer::GROUP_ID]],
            [[BaseMafiaInfoPeer::MAP_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseMap::className(), 'targetAttribute' => [BaseMafiaInfoPeer::MAP_ID => BaseMapPeer::MAP_ID]],
            [[BaseMafiaInfoPeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseMafiaInfoPeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMafiaInfoPeer::MAFIA_INFO_ID => 'Mafia Info ID',
            BaseMafiaInfoPeer::GROUP_ID => 'Group ID',
            BaseMafiaInfoPeer::MAP_ID => 'Map ID',
            BaseMafiaInfoPeer::USER_ID => 'User ID',
            BaseMafiaInfoPeer::STATUS => 'Status',
            BaseMafiaInfoPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\GroupQuery
     */
    public function getGroup() {
        return $this->hasOne(\models\Group::className(), [BaseGroupPeer::GROUP_ID => BaseMafiaInfoPeer::GROUP_ID]);
    }
        /**
     * @return \models\MapQuery
     */
    public function getMap() {
        return $this->hasOne(\models\Map::className(), [BaseMapPeer::MAP_ID => BaseMafiaInfoPeer::MAP_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseMafiaInfoPeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\MafiaInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MafiaInfoQuery(get_called_class());
    }
}
