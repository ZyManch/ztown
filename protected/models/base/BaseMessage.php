<?php

namespace models\base;



/**
 * This is the model class for table "city.message".
 *
 * @property string $message_id
 * @property string $user_first_id
 * @property string $user_second_id
 * @property string $title
 * @property string $content
 * @property string $created
 * @property string $readed
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $userFirst
 * @property \models\User $userSecond
 */
class BaseMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseMessagePeer::USER_FIRST_ID, BaseMessagePeer::USER_SECOND_ID, BaseMessagePeer::CONTENT], 'required'],
            [[BaseMessagePeer::USER_FIRST_ID, BaseMessagePeer::USER_SECOND_ID], 'integer'],
            [[BaseMessagePeer::CONTENT, BaseMessagePeer::READED, BaseMessagePeer::STATUS], 'string'],
            [[BaseMessagePeer::CREATED, BaseMessagePeer::CHANGED], 'safe'],
            [[BaseMessagePeer::TITLE], 'string', 'max' => 32],
            [[BaseMessagePeer::USER_FIRST_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseMessagePeer::USER_FIRST_ID => BaseUserPeer::USER_ID]],
            [[BaseMessagePeer::USER_SECOND_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseMessagePeer::USER_SECOND_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseMessagePeer::MESSAGE_ID => 'Message ID',
            BaseMessagePeer::USER_FIRST_ID => 'User First ID',
            BaseMessagePeer::USER_SECOND_ID => 'User Second ID',
            BaseMessagePeer::TITLE => 'Title',
            BaseMessagePeer::CONTENT => 'Content',
            BaseMessagePeer::CREATED => 'Created',
            BaseMessagePeer::READED => 'Readed',
            BaseMessagePeer::STATUS => 'Status',
            BaseMessagePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUserFirst() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseMessagePeer::USER_FIRST_ID]);
    }
        /**
     * @return \models\UserQuery
     */
    public function getUserSecond() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseMessagePeer::USER_SECOND_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\MessageQuery(get_called_class());
    }
}
