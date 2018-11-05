<?php

namespace models\base;



/**
 * This is the model class for table "city.friend".
 *
 * @property string $friend_id
 * @property string $first_user_id
 * @property string $second_user_id
 * @property string $type
 * @property string $is_confirmed
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $firstUser
 * @property \models\User $secondUser
 */
class BaseFriend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.friend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseFriendPeer::FIRST_USER_ID, BaseFriendPeer::SECOND_USER_ID], 'required'],
            [[BaseFriendPeer::FIRST_USER_ID, BaseFriendPeer::SECOND_USER_ID], 'integer'],
            [[BaseFriendPeer::TYPE, BaseFriendPeer::IS_CONFIRMED, BaseFriendPeer::STATUS], 'string'],
            [[BaseFriendPeer::CHANGED], 'safe'],
            [[BaseFriendPeer::FIRST_USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseFriendPeer::FIRST_USER_ID => BaseUserPeer::USER_ID]],
            [[BaseFriendPeer::SECOND_USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseFriendPeer::SECOND_USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseFriendPeer::FRIEND_ID => 'Friend ID',
            BaseFriendPeer::FIRST_USER_ID => 'First User ID',
            BaseFriendPeer::SECOND_USER_ID => 'Second User ID',
            BaseFriendPeer::TYPE => 'Type',
            BaseFriendPeer::IS_CONFIRMED => 'Is Confirmed',
            BaseFriendPeer::STATUS => 'Status',
            BaseFriendPeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getFirstUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseFriendPeer::FIRST_USER_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getSecondUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseFriendPeer::SECOND_USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\FriendQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\FriendQuery(get_called_class());
    }
}
