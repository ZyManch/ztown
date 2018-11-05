<?php

namespace models\base;



/**
 * This is the model class for table "city.user_can_change_name".
 *
 * @property string $user_can_change_name_id
 * @property string $user_id
 * @property string $expires
 * @property string $status
 * @property string $changed
 *
 * @property \models\User $user
 */
class BaseUserCanChangeName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city.user_can_change_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[BaseUserCanChangeNamePeer::USER_ID], 'integer'],
            [[BaseUserCanChangeNamePeer::EXPIRES, BaseUserCanChangeNamePeer::CHANGED], 'safe'],
            [[BaseUserCanChangeNamePeer::STATUS], 'string'],
            [[BaseUserCanChangeNamePeer::USER_ID], 'exist', 'skipOnError' => true, 'targetClass' => BaseUser::className(), 'targetAttribute' => [BaseUserCanChangeNamePeer::USER_ID => BaseUserPeer::USER_ID]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            BaseUserCanChangeNamePeer::USER_CAN_CHANGE_NAME_ID => 'User Can Change Name ID',
            BaseUserCanChangeNamePeer::USER_ID => 'User ID',
            BaseUserCanChangeNamePeer::EXPIRES => 'Expires',
            BaseUserCanChangeNamePeer::STATUS => 'Status',
            BaseUserCanChangeNamePeer::CHANGED => 'Changed',
        ];
    }
    /**
     * @return \models\UserQuery
     */
    public function getUser() {
        return $this->hasOne(\models\User::className(), [BaseUserPeer::USER_ID => BaseUserCanChangeNamePeer::USER_ID]);
    }
    
    /**
     * @inheritdoc
     * @return \models\UserCanChangeNameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\UserCanChangeNameQuery(get_called_class());
    }
}
